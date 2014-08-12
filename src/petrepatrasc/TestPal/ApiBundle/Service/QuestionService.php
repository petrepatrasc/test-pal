<?php


namespace petrepatrasc\TestPal\ApiBundle\Service;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use JMS\Serializer\Serializer;
use petrepatrasc\TestPal\ApiBundle\Entity\Question;

class QuestionService
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @var Serializer
     */
    protected $serializer;

    public function __construct(ObjectManager $manager, Serializer $serializer)
    {
        $this->manager = $manager;
        $this->serializer = $serializer;
    }

    public function scrambleAnswersForQuestionCollection(array $questions)
    {
        /** @var Question $question */
        foreach ($questions as $question) {
            $this->scrambleAnswersForQuestionEntity($question);
        }

        return $questions;
    }

    public function scrambleAnswersForQuestionEntity(Question $question)
    {
        $answers = $question->getAnswers()->toArray();
        shuffle($answers);

        $answersCollection = new ArrayCollection($answers);
        $question->setAnswers($answersCollection);

        return $question;
    }

    public function mergeQuestionEntity(Question $parentQuestion, Question $childQuestion)
    {
        if (null !== $childQuestion->getContent()) {
            $parentQuestion->setContent($childQuestion->getContent());
        }

        if (null !== $childQuestion->getCategory()) {
            $parentQuestion->setCategory($childQuestion->getCategory());
        }

        return $parentQuestion;
    }

    public function deserializeQuestion($json, $format = 'json')
    {
        $question = $this->serializer->deserialize($json, 'petrepatrasc\TestPal\ApiBundle\Entity\Question', $format);

        return $question;
    }

    public function readOneById($id)
    {
        $query = $this->manager->createQuery("
            SELECT q FROM TestPalApiBundle:Question q
            WHERE q.id = ?1
        ");

        $query->setMaxResults(1);
        $query->setParameter(1, $id);

        $question = $query->getSingleResult();

        return $question;
    }

    public function readOneByPermalinkAndId($permalink, $id)
    {
        $query = $this->manager->createQuery("
            SELECT q FROM TestPalApiBundle:Question q
            JOIN TestPalApiBundle:Test t
            WHERE q.id = ?1
            AND t.permalink = ?2
        ");

        $query->setMaxResults(1);
        $query->setParameter(1, $id);
        $query->setParameter(2, $permalink);

        $question = $query->getSingleResult();

        return $question;
    }
}