<?php


namespace petrepatrasc\TestPal\ClientBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Translation\Exception\InvalidResourceException;

class TestController extends Controller
{
    public function startTestAction($permalink)
    {
        $test = $this->getDoctrine()->getRepository('TestPalClientBundle:Test')->findOneBy([
            'permalink' => $permalink
        ]);

        if (null === $test) {
            throw new InvalidResourceException('Test permalink does not exist!');
        }

        return $this->render('@TestPalClient/Test/full-test.html.twig', [
            'test' => $test
        ]);
    }
} 