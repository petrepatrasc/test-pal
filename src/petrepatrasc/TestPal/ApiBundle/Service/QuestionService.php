<?php


namespace petrepatrasc\TestPal\ApiBundle\Service;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use JMS\Serializer\Serializer;
use petrepatrasc\TestPal\ApiBundle\Entity\Question;

class QuestionService extends RestService
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

    public function scrambleAnswersForQuestionArray(array $questions)
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
        return $this->manager->getRepository('TestPalApiBundle:Question')->readOneById($id);
    }

    public function readAllByTestPermalink($permalink) {
        return $this->manager->getRepository('TestPalApiBundle:Question')->readAllByTestPermalink($permalink);
    }

    public function readOneByPermalinkAndId($permalink, $id)
    {
        return $this->manager->getRepository('TestPalApiBundle:Question')->readOneByPermalinkAndId($permalink, $id);
    }
}