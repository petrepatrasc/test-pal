<?php


namespace petrepatrasc\TestPal\ApiBundle\Service;


use petrepatrasc\TestPal\ApiBundle\Entity\Test;

class ExaminationService extends RestService
{

    public function getTestEndTime(Test $test)
    {
        $currentTime = new \DateTime();
        $endTime = $currentTime->modify('+' . $test->getLength() . ' minutes');

        return $endTime;
    }

    public function generateUserKey()
    {
        $randomString = $this->generateRandomString(15);

        return $randomString;
    }
} 