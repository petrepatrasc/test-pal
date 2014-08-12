<?php


namespace petrepatrasc\TestPal\ApiBundle\Service;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use JMS\Serializer\Serializer;
use petrepatrasc\TestPal\ApiBundle\Entity\Test;

class TestService extends RestService
{
    /**
     * @var Serializer
     */
    protected $serializer;

    public function __construct(ObjectManager $manager, Serializer $serializer)
    {
        parent::__construct($manager);

        $this->serializer = $serializer;
    }

    public function scrambleQuestions(array $questions)
    {
        shuffle($questions);

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

    public function readAll()
    {
        return $this->manager->getRepository('TestPalApiBundle:Test')->readAll();
    }

    public function readOneByPermalink($permalink)
    {
        return $this->manager->getRepository('TestPalApiBundle:Test')->readOneByPermalink($permalink);
    }

    public function generatePermalink($name)
    {
        $permalink = strtolower($name);
        $permalink = str_replace(' ', '-', $permalink);
        $permalink .= '-' . rand(100, 999);

        return $permalink;
    }
} 