<?php


namespace petrepatrasc\TestPal\ClientBundle\Entity;

use Cegeka\SymfonyToolkitBundle\Entity\EntityBase;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="question")
 * @ORM\HasLifecycleCallbacks
 */
class Question extends EntityBase
{
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * @var Test
     * @ORM\ManyToOne(targetEntity="petrepatrasc\TestPal\ClientBundle\Entity\Test", inversedBy="questions")
     */
    protected $test;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="petrepatrasc\TestPal\ClientBundle\Entity\Answer", cascade={"persist", "remove"})
     */
    protected $answers;

    /**
     * @var string
     * @ORM\Column(type="text", name="content")
     */
    protected $content;

    /**
     * @var string
     * @ORM\Column(type="string", name="category")
     */
    protected $category;

    /**
     * @var Answer
     * @ORM\OneToOne(targetEntity="petrepatrasc\TestPal\ClientBundle\Entity\Answer")
     * @ORM\JoinColumn(name="correct_answer_id", referencedColumnName="id")
     */
    protected $correctAnswer;

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $answers
     * @return $this
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param string $category
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

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
     * @param \petrepatrasc\TestPal\ClientBundle\Entity\Test $test
     * @return $this
     */
    public function setTest($test)
    {
        $this->test = $test;
        return $this;
    }

    /**
     * @return \petrepatrasc\TestPal\ClientBundle\Entity\Test
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param \petrepatrasc\TestPal\ClientBundle\Entity\Answer $correctAnswer
     * @return $this
     */
    public function setCorrectAnswer($correctAnswer)
    {
        $this->correctAnswer = $correctAnswer;
        return $this;
    }

    /**
     * @return \petrepatrasc\TestPal\ClientBundle\Entity\Answer
     */
    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }


} 