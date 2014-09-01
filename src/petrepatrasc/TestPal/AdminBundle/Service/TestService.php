<?php


namespace petrepatrasc\TestPal\AdminBundle\Service;


use Doctrine\Common\Collections\ArrayCollection;

class TestService extends BaseService
{
    public function readAll()
    {
        $path = $this->getRouter()->generate('testpal.api.test.read_all', [], true);

        $results = $this->getGuzzleClient()->get($path)->getBody();

        $tests = $this->getSerializer()->deserialize($results, 'array<petrepatrasc\TestPal\ApiBundle\Entity\Test>', 'json');
        return $tests;
    }
} 