<?php


namespace petrepatrasc\TestPal\AdminBundle\Service;


class QuestionService extends BaseService
{
    public function readAll($testPermalink)
    {
        $path = $this->getRouter()->generate('tp.api.question.read_all', ['permalink' => $testPermalink], true);
        $response = $this->getGuzzleClient()->get($path)->getBody();

        $questions = $this->getSerializer()->deserialize($response, 'array<petrepatrasc\TestPal\ApiBundle\Entity\Question>', 'json');
        return $questions;
    }
} 