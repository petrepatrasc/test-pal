<?php


namespace petrepatrasc\TestPal\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;

class TestController extends FOSRestController
{
    public function readAllAction()
    {
        $data = $this->getDoctrine()->getRepository('TestPalApiBundle:Test')->findAll();

        $view = $this->view($data, 200);
        return $this->handleView($view);
    }
} 