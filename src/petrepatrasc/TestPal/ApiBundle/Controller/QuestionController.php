<?php

namespace petrepatrasc\TestPal\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;

class QuestionController extends FOSRestController
{
    public function showAction($id)
    {
        $question = $this->get('tp.api.search.service')->findQuestionById(intval($id));

        $view = $this->view($question, 200);
        return $this->handleView($view);
    }
} 