<?php


namespace petrepatrasc\TestPal\ApiBundle\Tests\Unit\Service;


use petrepatrasc\TestPal\ApiBundle\Service\BaseService;

class BaseServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var BaseService */
    protected $baseService;

    public function setUp()
    {
        $this->baseService = new BaseService();
    }

    /**
     * @param $length
     * @dataProvider randomStringDataProvider
     */
    public function testGenerateRandomString($length)
    {
        $randomString = $this->baseService->generateRandomString($length);

        $this->assertNotNull($randomString);
        $this->assertInternalType('string', $randomString);
        $this->assertEquals($length, strlen($randomString));
    }

    public function randomStringDataProvider()
    {
        return [
            [10],
            [15]
        ];
    }
} 