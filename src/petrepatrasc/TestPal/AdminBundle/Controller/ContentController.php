<?php


namespace petrepatrasc\TestPal\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContentController extends Controller
{
    public function dashboardAction()
    {
        return $this->render('@TestPalAdmin/Content/dashboard.html.twig');
    }
} 