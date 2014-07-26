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
        $question->setTitle('Agile')
            ->setContent('The trend of work remaining across time in a Sprint, a release, or a product, with work remaining tracked on the vertical axis and the time periods tracked on the horizontal axis. Is called?');
        $manager->persist($question);

        $question = new Question();
        $question->setTitle('PHP')
            ->setContent('Given the string $data = ABCD, what will running strtolower(strtoupper($data)) return?');
        $manager->persist($question);

        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
} 