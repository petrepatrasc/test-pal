<?php


namespace petrepatrasc\TestPal\ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="petrepatrasc\TestPal\ApiBundle\Repository\QuestionRepository")
 * @ORM\Table(name="question")
 * @ORM\HasLifecycleCallbacks
 * @JMS\ExclusionPolicy("none")
 */
class Question extends EntityBase
{
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * @var Test
     * @ORM\ManyToOne(targetEntity="petrepatrasc\TestPal\ApiBundle\Entity\Test", inversedBy="questions")
     * @JMS\Exclude
     */
    protected $test;

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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="petrepatrasc\TestPal\ApiBundle\Entity\Answer", mappedBy="question", cascade={"persist"})
     */
    protected $answers;

    /**
     * @var Answer
     * @ORM\OneToOne(targetEntity="petrepatrasc\TestPal\ApiBundle\Entity\Answer")
     * @ORM\JoinColumn(name="correct_answer_id", referencedColumnName="id")
     */
    protected $correctAnswer;

    /**
     * Set content
     *
     * @param string $content
     * @return Question
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Question
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set test
     *
     * @param \petrepatrasc\TestPal\ApiBundle\Entity\Test $test
     * @return Question
     */
    public function setTest(\petrepatrasc\TestPal\ApiBundle\Entity\Test $test = null)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return \petrepatrasc\TestPal\ApiBundle\Entity\Test
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Add answers
     *
     * @param \petrepatrasc\TestPal\ApiBundle\Entity\Answer $answers
     * @return Question
     */
    public function addAnswer(\petrepatrasc\TestPal\ApiBundle\Entity\Answer $answers)
    {
        $this->answers[] = $answers;
        $answers->setQuestion($this);

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \petrepatrasc\TestPal\ApiBundle\Entity\Answer $answers
     */
    public function removeAnswer(\petrepatrasc\TestPal\ApiBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
        $answers->setQuestion(null);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param \petrepatrasc\TestPal\ApiBundle\Entity\Answer $correctAnswer
     * @return $this
     */
    public function setCorrectAnswer($correctAnswer)
    {
        $this->correctAnswer = $correctAnswer;
        return $this;
    }

    /**
     * @return \petrepatrasc\TestPal\ApiBundle\Entity\Answer
     */
    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $answers
     * @return $this
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
        return $this;
    }


}
