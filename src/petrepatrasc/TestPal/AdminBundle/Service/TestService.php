<?php


namespace petrepatrasc\TestPal\AdminBundle\Service;


use petrepatrasc\TestPal\ApiBundle\Entity\Test;

class TestService extends BaseService
{
    public function readAll()
    {
        $path = $this->getRouter()->generate('tp.api.test.read_all', [], true);

        $results = $this->getGuzzleClient()->get($path)->getBody();

        $tests = $this->getSerializer()->deserialize($results, 'array<petrepatrasc\TestPal\ApiBundle\Entity\Test>', 'json');
        return $tests;
    }

    /**
     * @param $permalink
     * @return Test
     */
    public function readOneByPermalink($permalink)
    {
        $path = $this->getRouter()->generate('tp.api.test.read_one', ['permalink' => $permalink], true);

        $result = $this->getGuzzleClient()->get($path)->getBody();

        $test = $this->getSerializer()->deserialize($result, 'petrepatrasc\TestPal\ApiBundle\Entity\Test', 'json');
        return $test;
    }

    public function updateOne($permalink, Test $test)
    {
        $path = $this->getRouter()->generate('tp.api.test.update_one', ['permalink' => $permalink], true);
        $serializedEntity = $this->getSerializer()->serialize($test, 'json');

        $request = $this->getGuzzleClient()->createRequest('put', $path, ['body' => $serializedEntity]);
        $response = $this->getGuzzleClient()->send($request);

        return $response;
    }
} 