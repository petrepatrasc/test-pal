<?php


namespace petrepatrasc\TestPal\ClientBundle\Controller;


use petrepatrasc\TestPal\ClientBundle\Entity\Examination;
use petrepatrasc\TestPal\ClientBundle\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Exception\InvalidResourceException;

class TestController extends Controller
{
    public function showResultsAction($permalink, $userKey)
    {
        /** @var Examination $examination */
        $examination = $this->retrieveExamination($permalink, $userKey);
        $answers = json_decode($examination->getAnswers(), true);

        $categoryData = [];

        /** @var Question $question */
        foreach ($examination->getTest()->getQuestions() as $question) {
            if (!array_key_exists($question->getCategory(), $categoryData)) {
                $categoryData[$question->getCategory()] = [
                    'correct' => 0,
                    'total' => 0,
                ];
            }

            $userAnswer = $answers[$question->getId()];

            if ($userAnswer === $question->getCorrectAnswer()->getId()) {
                $categoryData[$question->getCategory()]['correct'] ++;
            }

            $categoryData[$question->getCategory()]['total'] ++;
        }

        return $this->render('@TestPalClient/Test/test-results.html.twig', [
            'examination' => $examination,
            'categoryData' => $categoryData,
        ]);
    }

    public function submitTestAction(Request $request, $permalink, $userKey)
    {
        /** @var Examination $examination */
        $examination = $this->retrieveExamination($permalink, $userKey);

        if (true === $examination->getFinished()) {
            throw new AccessDeniedException('This examination has already been submitted.');
        }

        $answers = [];
        $score = 0;
        $questions = $examination->getTest()->getQuestions();
        /** @var Question $question */
        foreach ($questions as $question) {
            $userAnswer = (int)$request->get('question_' . $question->getId());

            if ($userAnswer === $question->getCorrectAnswer()->getId()) {
                $score++;
            }

            $answers[$question->getId()] = $userAnswer;
        }

        $examination->setScore($score)
            ->setFinished(true)
            ->setAnswers(json_encode($answers));

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($examination);
        $manager->flush();

        return $this->redirect($this->generateUrl('tp_test_results', [
            'permalink' => $examination->getTest()->getPermalink(),
            'userKey' => $examination->getUserKey(),
        ]));
    }

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
        $examination = $this->retrieveExamination($permalink, $userKey);

        if (true === $examination->getFinished()) {
            throw new AccessDeniedException('This examination has already been submitted.');
        }

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

    /**
     * @param $permalink
     * @param $userKey
     * @throws \Symfony\Component\Translation\Exception\InvalidResourceException
     */
    protected function retrieveExamination($permalink, $userKey)
    {
        $examination = $this->getDoctrine()->getRepository('TestPalClientBundle:Examination')->findOneBy([
            'userKey' => $userKey,
        ]);

        if (null === $examination || $permalink !== $examination->getTest()->getPermalink()) {
            throw new InvalidResourceException('Examination could not be retrieved!');
        }

        return $examination;
    }
} 