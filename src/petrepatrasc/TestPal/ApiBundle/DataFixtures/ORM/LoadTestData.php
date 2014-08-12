<?php


namespace petrepatrasc\TestPal\ApiBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use petrepatrasc\TestPal\ApiBundle\Entity\Test;

class LoadTestData implements FixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $test = new Test();

        $test->setName('Senior PHP Developer')
            ->setPermalink('senior-php-developer-318')
            ->setLength(60);

        $manager->persist($test);
        $manager->flush();

        $test = new Test();

        $test->setName('Angular JS Specialist')
            ->setPermalink('angular-js-specialist-453')
            ->setLength(50);

        $manager->persist($test);
        $manager->flush();
    }
}