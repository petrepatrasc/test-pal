<?php


namespace petrepatrasc\TestPal\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    }
} 