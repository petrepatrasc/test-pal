<?php


namespace petrepatrasc\TestPal\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;

class BaseController extends FOSRestController
{
    public function sendResponse($data, $code = 200)
    {
        $view = $this->view($data, $code);
        return $this->handleView($view);
    }

    public function sendError($message, $code)
    {
        $data = [
            'errorCode' => $code,
            'errorMessage' => $message,
        ];

        return $this->sendResponse($data, $code);
    }

    public function sendResourceNotFound($message = 'Resource not found', $code = 404)
    {
        return $this->sendError($message, $code);
    }

    public function sendInvalidArguments($message = 'Invalid argument', $code = 400)
    {
        return $this->sendError($message, $code);
    }
} 