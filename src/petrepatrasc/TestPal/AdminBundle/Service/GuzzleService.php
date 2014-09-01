<?php


namespace petrepatrasc\TestPal\AdminBundle\Service;

use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class GuzzleService
{

    /** @var Client */
    protected $guzzleClient;

    /** @var Router */
    protected $router;

    /** @var Serializer */
    protected $serializer;

    public function __construct(Router $router, Serializer $serializer)
    {
        $this->guzzleClient = new Client();
        $this->router = $router;
        $this->serializer = $serializer;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getGuzzleClient()
    {
        return $this->guzzleClient;
    }

    /**
     * @return \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    public function getRouter()
    {
        return $this->router;
    }

    public function getSerializer()
    {
        return $this->serializer;
    }


} 