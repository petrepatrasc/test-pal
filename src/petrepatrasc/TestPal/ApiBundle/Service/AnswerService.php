<?php


namespace petrepatrasc\TestPal\ApiBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use JMS\Serializer\Serializer;
use petrepatrasc\TestPal\ApiBundle\Entity\Answer;

class AnswerService extends RestService
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

    public function mergeAnswerEntity(Answer $parent, Answer $child)
    {
        if (null !== $child->getContent()) {
            $parent->setContent($child->getContent());
        }

        return $parent;
    }

    public function deserializeAnswer($data, $format = 'json')
    {
        return $this->serializer->deserialize($data, 'petrepatrasc\TestPal\ApiBundle\Entity\Answer', $format);
    }

    public function readAllByQuestionId($questionId)
    {
        return $this->manager->getRepository('TestPalApiBundle:Answer')->readAllByQuestionId($questionId);
    }

    public function readOneById($id)
    {
        return $this->manager->getRepository('TestPalApiBundle:Answer')->readOneById($id);
    }
} 