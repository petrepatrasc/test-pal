<?php


namespace petrepatrasc\TestPal\AdminBundle\Service;


class BaseService
{
    /** @var GuzzleService */
    protected $guzzle;

    public function __construct(GuzzleService $guzzleService)
    {
        $this->guzzle = $guzzleService;
    }

    public function getRouter()
    {
        return $this->guzzle->getRouter();
    }

    public function getSerializer()
    {
        return $this->guzzle->getSerializer();
    }

    public function getGuzzleClient()
    {
        return $this->guzzle->getGuzzleClient();
    }
} 