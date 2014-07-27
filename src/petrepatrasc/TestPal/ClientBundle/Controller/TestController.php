<?php


namespace petrepatrasc\TestPal\ClientBundle\Controller;


use petrepatrasc\TestPal\ClientBundle\Entity\Examination;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Exception\InvalidResourceException;

class TestController extends Controller
{
    public function startTestAction(Request $request, $permalink)
    {
        $test = $this->getTestByPermalink($permalink);
        $fullName = $request->get('fullname');

        $endTime = new \DateTime();
        $endTime->modify('+' . $test->getLength() . ' minutes');

        $examination = new Examination();
        $examination->setTest($test)
            ->setCandidateName($fullName)
            ->setUserKey(uniqid('exam'), true)
            ->setEndTime($endTime);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($examination);
        $manager->flush();

        return $this->redirect($this->generateUrl('tp_test_display_questions', [
            'permalink' => $permalink,
            'userKey' => $examination->getUserKey(),
        ]));
    }

    public function displayQuestionsAction($permalink, $userKey)
    {
        $examination = $this->getDoctrine()->getRepository('TestPalClientBundle:Examination')->findOneBy([
            'userKey' => $userKey,
        ]);

        return $this->render('@TestPalClient/Test/full-test.html.twig', [
            'examination' => $examination,
        ]);
    }

    public function displayTestInformationAction($permalink)
    {
        $test = $this->getTestByPermalink($permalink);

        $testCategories = $this->extractUniqueTestCategories($test);

        return $this->render('@TestPalClient/Test/test-information.html.twig', [
            'test' => $test,
            'testCategories' => $testCategories,
        ]);
    }

    /**
     * @param $test
     */
    protected function extractUniqueTestCategories($test)
    {
        $testCategories = [];
        foreach ($test->getQuestions() as $question) {
            $testCategories[] = $question->getCategory();
        }
        return array_unique($testCategories);
    }

    /**
     * @param $permalink
     * @return \petrepatrasc\TestPal\ClientBundle\Entity\Test
     * @throws \Symfony\Component\Translation\Exception\InvalidResourceException
     */
    protected function getTestByPermalink($permalink)
    {
        $test = $this->getDoctrine()->getRepository('TestPalClientBundle:Test')->findOneBy([
            'permalink' => $permalink
        ]);

        if (null === $test) {
            throw new InvalidResourceException('Test permalink does not exist!');
        }
        return $test;
    }
} 