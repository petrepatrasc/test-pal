<?php


namespace petrepatrasc\TestPal\ApiBundle\Service;


class BaseService
{
    public function generateRandomString($length = 10)
    {
        return substr(str_shuffle(MD5(microtime())), 0, $length);
    }
} 