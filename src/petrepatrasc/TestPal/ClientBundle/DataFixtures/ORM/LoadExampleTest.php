<?php


namespace petrepatrasc\TestPal\ClientBundle\DataFixtures\ORM;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use petrepatrasc\TestPal\ClientBundle\Entity\Answer;
use petrepatrasc\TestPal\ClientBundle\Entity\Question;
use petrepatrasc\TestPal\ClientBundle\Entity\Test;

class LoadExampleTest implements FixtureInterface
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

        $questions = new ArrayCollection();
        $questions->add($questionOne);
        $questions->add($questionTwo);
        $questions->add($questionThree);
        $questions->add($questionFour);

        $test->setQuestions($questions);

        $manager->persist($test);
        $manager->flush();
    }

    protected function setUpTest()
    {
        $test = new Test();
        $test->setName('Senior PHP Developer')
            ->setPermalink('senior-php-dev-hhvm');

        return $test;
    }

    /**
     * @param $test
     * @return Question
     */
    protected function setUpQuestionOne($test)
    {
        $answerOne = new Answer();
        $answerOne->setAssignedIdentifier('a')
            ->setContent('Change will always be a problem');

        $answerTwo = new Answer();
        $answerTwo->setAssignedIdentifier('b')
            ->setContent('Change must be restricted');

        $answerThree = new Answer();
        $answerThree->setAssignedIdentifier('c')
            ->setContent('Change will cause delays to the timescale');

        $answerFour = new Answer();
        $answerFour->setAssignedIdentifier('d')
            ->setContent('Change is inevitable');

        $answers = new ArrayCollection();
        $answers->add($answerOne);
        $answers->add($answerTwo);
        $answers->add($answerThree);
        $answers->add($answerFour);

        $question = new Question();
        $question->setContent('Stakeholders must be prepared to accept that, as they understand more about the solution being developed:')
            ->setCorrectAnswerIdentifier('d')
            ->setAnswers($answers)
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
        $answerOne->setAssignedIdentifier('a')
            ->setContent('Deliver on time');

        $answerTwo = new Answer();
        $answerTwo->setAssignedIdentifier('b')
            ->setContent('Collaborate');

        $answerThree = new Answer();
        $answerThree->setAssignedIdentifier('c')
            ->setContent('Never compromise quality');

        $answerFour = new Answer();
        $answerFour->setAssignedIdentifier('d')
            ->setContent('Build incrementally from firm foundations');

        $answers = new ArrayCollection();
        $answers->add($answerOne);
        $answers->add($answerTwo);
        $answers->add($answerThree);
        $answers->add($answerFour);

        $question = new Question();
        $question->setContent('Which Atern principle is specifically supported by the concept of ‘Build a one-team culture’?')
            ->setCorrectAnswerIdentifier('b')
            ->setAnswers($answers)
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
        $answerOne->setAssignedIdentifier('a')
            ->setContent('.. plans the detail of the actual delivery of the product(s), but validates the outcome
with a Facilitated Workshop, in line with the Atern concept of empowerment');

        $answerTwo = new Answer();
        $answerTwo->setAssignedIdentifier('b')
            ->setContent('.. is empowered to replace the Timebox Plans with better ones that s/he has created');

        $answerThree = new Answer();
        $answerThree->setAssignedIdentifier('c')
            ->setContent('.. has to delegate responsibility to the Solution Development Team, but still needs to
be the final decision maker for all day-to-day decisions, to ensure the right solution is
actually created.');

        $answerFour = new Answer();
        $answerFour->setAssignedIdentifier('d')
            ->setContent('.. is expected to leave the detailed planning of the actual delivery of the product(s) to
the Team Leader and members of the Solution Development Team, in line with the
Atern concept of empowerment');

        $answers = new ArrayCollection();
        $answers->add($answerOne);
        $answers->add($answerTwo);
        $answers->add($answerThree);
        $answers->add($answerFour);

        $question = new Question();
        $question->setContent('The Agile Project Manager…')
            ->setCorrectAnswerIdentifier('d')
            ->setAnswers($answers)
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
        $answerOne->setAssignedIdentifier('a')
            ->setContent('Models can be temporary, transient, throwaway or may be a prototype which forms
part of the eventual solution');

        $answerTwo = new Answer();
        $answerTwo->setAssignedIdentifier('b')
            ->setContent('Object oriented modelling is a mandated part of Atern');

        $answerThree = new Answer();
        $answerThree->setAssignedIdentifier('c')
            ->setContent('Atern encourages formal modelling techniques, preferably in an electronic format, so
they can be properly controlled');

        $answerFour = new Answer();
        $answerFour->setAssignedIdentifier('d')
            ->setContent('Models are always temporary, and are superceded once the real work starts');

        $answers = new ArrayCollection();
        $answers->add($answerOne);
        $answers->add($answerTwo);
        $answers->add($answerThree);
        $answers->add($answerFour);

        $question = new Question();
        $question->setContent('Which of the following statements is true?')
            ->setCorrectAnswerIdentifier('d')
            ->setAnswers($answers)
            ->setCategory('Agile')
            ->setTest($test);

        return $question;
    }

} 