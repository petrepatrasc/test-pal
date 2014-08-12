<?php


namespace petrepatrasc\TestPal\ApiBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 * @ORM\Table(name="answer")
 * @ORM\HasLifecycleCallbacks
 */
class Answer extends EntityBase
{
    /**
     * @var Question
     * @ORM\ManyToOne(targetEntity="petrepatrasc\TestPal\ApiBundle\Entity\Question")
     */
    protected $question;

    /**
     * @var string
     * @ORM\Column(type="text", name="content")
     */
    protected $content;

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param \petrepatrasc\TestPal\ApiBundle\Entity\Question $question
     * @return $this
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return \petrepatrasc\TestPal\ApiBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
