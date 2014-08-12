<?php


namespace petrepatrasc\TestPal\ApiBundle\DataFixtures\ORM;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use petrepatrasc\TestPal\ApiBundle\Entity\Answer;
use petrepatrasc\TestPal\ApiBundle\Entity\Question;
use petrepatrasc\TestPal\ApiBundle\Entity\Test;

class LoadTestData implements FixtureInterface
{

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $test = $this->setUpTest();

        $questionOne = $this->setUpQuestionOne($test);
        $questionTwo = $this->setUpQuestionTwo($test);
        $questionThree = $this->setUpQuestionThree($test);
        $questionFour = $this->setUpQuestionFour($test);

        $test->addQuestion($questionOne)
            ->addQuestion($questionTwo)
            ->addQuestion($questionThree)
            ->addQuestion($questionFour);

        $manager->persist($test);
        $manager->flush();
    }

    protected function setUpTest()
    {
        $test = new Test();
        $test->setName('Senior PHP Developer')
            ->setPermalink('senior-php-developer-318')
            ->setLength(60);

        return $test;
    }

    /**
     * @param $test
     * @return Question
     */
    protected function setUpQuestionOne($test)
    {
        $answerOne = new Answer();
        $answerOne->setContent('Change will always be a problem');

        $answerTwo = new Answer();
        $answerTwo->setContent('Change must be restricted');

        $answerThree = new Answer();
        $answerThree->setContent('Change will cause delays to the timescale');

        $answerFour = new Answer();
        $answerFour->setContent('Change is inevitable');

        $question = new Question();
        $question->setContent('Stakeholders must be prepared to accept that, as they understand more about the solution being developed:')
            ->setCorrectAnswer($answerFour)
            ->addAnswer($answerOne)
            ->addAnswer($answerTwo)
            ->addAnswer($answerThree)
            ->addAnswer($answerFour)
            ->setCategory('Agile')
            ->setTest($test);

        return $question;
    }

    /**
     * @param $test
     * @return Question
     */
    protected function setUpQuestionTwo($test)
    {
        $answerOne = new Answer();
        $answerOne->setContent('Deliver on time');

        $answerTwo = new Answer();
        $answerTwo->setContent('Collaborate');

        $answerThree = new Answer();
        $answerThree->setContent('Never compromise quality');

        $answerFour = new Answer();
        $answerFour->setContent('Build incrementally from firm foundations');

        $question = new Question();
        $question->setContent('Which Atern principle is specifically supported by the concept of ‘Build a one-team culture’?')
            ->setCorrectAnswer($answerTwo)
            ->addAnswer($answerOne)
            ->addAnswer($answerTwo)
            ->addAnswer($answerThree)
            ->addAnswer($answerFour)
            ->setCategory('Atern')
            ->setTest($test);

        return $question;
    }

    /**
     * @param $test
     * @return Question
     */
    protected function setUpQuestionThree($test)
    {
        $answerOne = new Answer();
        $answerOne->setContent('.. plans the detail of the actual delivery of the product(s), but validates the outcome
with a Facilitated Workshop, in line with the Atern concept of empowerment');

        $answerTwo = new Answer();
        $answerTwo->setContent('.. is empowered to replace the Timebox Plans with better ones that s/he has created');

        $answerThree = new Answer();
        $answerThree->setContent('.. has to delegate responsibility to the Solution Development Team, but still needs to
be the final decision maker for all day-to-day decisions, to ensure the right solution is
actually created.');

        $answerFour = new Answer();
        $answerFour->setContent('.. is expected to leave the detailed planning of the actual delivery of the product(s) to
the Team Leader and members of the Solution Development Team, in line with the
Atern concept of empowerment');

        $question = new Question();
        $question->setContent('The Agile Project Manager…')
            ->setCorrectAnswer($answerFour)
            ->addAnswer($answerOne)
            ->addAnswer($answerTwo)
            ->addAnswer($answerThree)
            ->addAnswer($answerFour)
            ->setCategory('Roles')
            ->setTest($test);

        return $question;
    }

    /**
     * @param $test
     * @return Question
     */
    protected function setUpQuestionFour($test)
    {
        $answerOne = new Answer();
        $answerOne->setContent('Models can be temporary, transient, throwaway or may be a prototype which forms
part of the eventual solution');

        $answerTwo = new Answer();
        $answerTwo->setContent('Object oriented modelling is a mandated part of Atern');

        $answerThree = new Answer();
        $answerThree->setContent('Atern encourages formal modelling techniques, preferably in an electronic format, so
they can be properly controlled');

        $answerFour = new Answer();
        $answerFour->setContent('Models are always temporary, and are superceded once the real work starts');

        $question = new Question();
        $question->setContent('Which of the following statements is true?')
            ->setCorrectAnswer($answerFour)
            ->addAnswer($answerOne)
            ->addAnswer($answerTwo)
            ->addAnswer($answerThree)
            ->addAnswer($answerFour)
            ->setCategory('Agile')
            ->setTest($test);

        return $question;
    }
}