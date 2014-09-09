<?php


namespace petrepatrasc\TestPal\AdminBundle\Controller;


use petrepatrasc\TestPal\ApiBundle\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    public function listAction()
    {
        $tests = $this->get('tp.admin.test.service')->readAll();

        return $this->render('@TestPalAdmin/Test/list.html.twig', [
            'tests' => $tests,
        ]);
    }

    public function readOneAction($permalink)
    {
        $test = $this->get('tp.admin.test.service')->readOneByPermalink($permalink);
        $questions = $this->get('tp.admin.question.service')->readAll($permalink);

        return $this->render('@TestPalAdmin/Test/detail.html.twig', [
            'test' => $test,
            'questions' => $questions,
        ]);
    }

    public function createOneAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $name = $request->get('name');
            $length = $request->get('length');

            $test = new Test();
            $test->setName($name)
                ->setLength($length);

            $this->get('tp.admin.test.service')->createOne($test);
            return $this->redirect($this->generateUrl('tp.admin.test.list'));
        }

        return $this->render('@TestPalAdmin/Test/create.html.twig');
    }

    public function updateOneAction(Request $request, $permalink)
    {
        $test = $this->get('tp.admin.test.service')->readOneByPermalink($permalink);

        if ($request->isMethod('POST')) {
            $name = $request->get('name');
            $length = $request->get('length');

            $test->setName($name)
                ->setLength($length);

            $this->get('tp.admin.test.service')->updateOne($permalink, $test);
            return $this->redirect($this->generateUrl('tp.admin.test.read_one', ['permalink' => $permalink]));
        }

        return $this->render('@TestPalAdmin/Test/edit.html.twig', [
            'test' => $test,
        ]);
    }

    public function deleteOneAction($permalink)
    {
        $test = $this->get('tp.admin.test.service')->readOneByPermalink($permalink);

        if (null !== $test) {
            $this->get('tp.admin.test.service')->deleteOne($permalink);
        }

        return $this->redirect($this->generateUrl('tp.admin.test.list'));
    }
} 