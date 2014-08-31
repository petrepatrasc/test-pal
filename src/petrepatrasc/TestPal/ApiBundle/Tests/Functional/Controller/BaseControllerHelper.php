<?php


namespace petrepatrasc\TestPal\ApiBundle\Tests\Functional\Controller;


use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseControllerHelper extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    /**
     * @param $url
     * @param string $method
     * @param array $parameters
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    public function navigateToUrl($url, $method = 'GET', $success = true)
    {
        $this->client->request($method, $url);
        $this->assertEquals($success, $this->client->getResponse()->isSuccessful(), $this->client->getResponse()->getContent());

        $responseData = $this->client->getResponse()->getContent();

        $jsonData = json_decode($responseData);
        return $jsonData;
    }

    public function postJson($url, $method = 'POST', $jsonString = '{}', $success = true)
    {
        $this->client->request($method, $url, [], [], ['CONTENT_TYPE' => 'application/json'], $jsonString);
        $this->assertEquals($success, $this->client->getResponse()->isSuccessful(), $this->client->getResponse()->getContent());

        $responseData = $this->client->getResponse()->getContent();

        $jsonData = json_decode($responseData);
        return $jsonData;
    }
} 