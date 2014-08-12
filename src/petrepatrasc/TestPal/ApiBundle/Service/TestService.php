<?php


namespace petrepatrasc\TestPal\ApiBundle\Service;


use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Serializer;
use petrepatrasc\TestPal\ApiBundle\Entity\Test;

class TestService
{
    /**
     * @var Serializer
     */
    protected $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function scrambleQuestions(Test $test)
    {
        $questions = $test->getQuestions()->toArray();
        shuffle($questions);

        $questionsCollection = new ArrayCollection($questions);
        $test->setQuestions($questionsCollection);

        return $questions;
    }

    public function mergeTestEntity(Test $parent, Test $child)
    {
        if (null !== $child->getName()) {
            $parent->setName($child->getName());
        }

        if (null !== $child->getLength()) {
            $parent->setLength($child->getLength());
        }

        return $parent;
    }

    public function deserializeTest($json, $format = 'json')
    {
        /** @var Test $test */
        $test = $this->serializer->deserialize($json, 'petrepatrasc\TestPal\ApiBundle\Entity\Test', $format);

        return $test;
    }

    public function generatePermalink($name)
    {
        $permalink = strtolower($name);
        $permalink = str_replace(' ', '-', $permalink);
        $permalink .= '-' . rand(100, 999);

        return $permalink;
    }
} 