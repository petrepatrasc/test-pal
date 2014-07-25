<?php


namespace petrepatrasc\TestPal\ApiBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use petrepatrasc\TestPal\ApiBundle\Entity\Question;

class LoadQuestions extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $question = new Question();

        $question->setTitle('Tip-top')
            ->setContent('Lorem ipsum');

        $manager->persist($question);
        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
} 