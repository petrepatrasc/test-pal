<?php


namespace petrepatrasc\TestPal\AdminBundle\Service;


class TestService extends BaseService
{
    public function readAll()
    {
        $path = $this->getRouter()->generate('tp.api.test.read_all', [], true);

        $results = $this->getGuzzleClient()->get($path)->getBody();

        $tests = $this->getSerializer()->deserialize($results, 'array<petrepatrasc\TestPal\ApiBundle\Entity\Test>', 'json');
        return $tests;
    }

    public function readOneByPermalink($permalink) {
        $path = $this->getRouter()->generate('tp.api.test.read_one', ['permalink' => $permalink], true);

        $result = $this->getGuzzleClient()->get($path)->getBody();

        $test = $this->getSerializer()->deserialize($result, 'petrepatrasc\TestPal\ApiBundle\Entity\Test', 'json');
        return $test;
    }
} 