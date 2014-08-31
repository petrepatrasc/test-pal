<?php


namespace petrepatrasc\TestPal\ApiBundle\Entity;


use Cegeka\SymfonyToolkitBundle\Entity\EntityBase;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="examination")
 * @ORM\HasLifecycleCallbacks
 */
class Examination extends EntityBase
{
    /**
     * @var string
     * @ORM\Column(type="string", name="candidate_name")
     */
    protected $candidateName;

    /**
     * @var Test
     * @ORM\ManyToOne(targetEntity="petrepatrasc\TestPal\ApiBundle\Entity\Test")
     */
    protected $test;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="end_time")
     */
    protected $endTime;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="finished")
     */
    protected $finished = false;

    /**
     * @var int
     * @ORM\Column(type="integer", name="score")
     */
    protected $score = 0;

    /**
     * @var string
     * @ORM\Column(type="string", name="user_key")
     * @Assert\NotNull
     * @Assert\Length(
     * min = "2",
     * max = "160",
     * minMessage = "Your position must be at least {{ limit }} characters length",
     * maxMessage = "Your position cannot be longer than {{ limit }} characters length"
     * )
     */
    protected $userKey;

    /**
     * @var string
     * @ORM\Column(type="text", name="answers_json", nullable=true)
     */
    protected $answers;

    /**
     * @param string $answers
     * @return $this
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param string $candidateName
     * @return $this
     */
    public function setCandidateName($candidateName)
    {
        $this->candidateName = $candidateName;
        return $this;
    }

    /**
     * @return string
     */
    public function getCandidateName()
    {
        return $this->candidateName;
    }

    /**
     * @param \DateTime $endTime
     * @return $this
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param boolean $finished
     * @return $this
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @param int $score
     * @return $this
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param \petrepatrasc\TestPal\ApiBundle\Entity\Test $test
     * @return $this
     */
    public function setTest($test)
    {
        $this->test = $test;
        return $this;
    }

    /**
     * @return \petrepatrasc\TestPal\ApiBundle\Entity\Test
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param string $userKey
     * @return $this
     */
    public function setUserKey($userKey)
    {
        $this->userKey = $userKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserKey()
    {
        return $this->userKey;
    }


} 