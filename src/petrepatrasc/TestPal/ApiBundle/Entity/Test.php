<?php


namespace petrepatrasc\TestPal\ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="petrepatrasc\TestPal\ApiBundle\Repository\TestRepository")
 * @ORM\Table(name="test")
 * @ORM\HasLifecycleCallbacks
 * @JMS\ExclusionPolicy("none")
 */
class Test extends EntityBase
{
    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @var string
     * @ORM\Column(type="string")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false)
     */
    protected $permalink;

    /**
     * @var int
     * @ORM\Column(type="integer")
     * @JMS\Type("integer")
     * @JMS\XmlElement(cdata=false)
     */
    protected $length;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="petrepatrasc\TestPal\ApiBundle\Entity\Question", mappedBy="test", cascade={"persist"})
     * @JMS\Exclude()
     */
    protected $questions;

    /**
     * Set name
     *
     * @param string $name
     * @return Test
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set permalink
     *
     * @param string $permalink
     * @return Test
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;

        return $this;
    }

    /**
     * Get permalink
     *
     * @return string 
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * Set length
     *
     * @param integer $length
     * @return Test
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return integer 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Add questions
     *
     * @param \petrepatrasc\TestPal\ApiBundle\Entity\Question $questions
     * @return Test
     */
    public function addQuestion(\petrepatrasc\TestPal\ApiBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;
        $questions->setTest($this);

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \petrepatrasc\TestPal\ApiBundle\Entity\Question $questions
     */
    public function removeQuestion(\petrepatrasc\TestPal\ApiBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
        $questions->setTest(null);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $questions
     * @return $this
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
        return $this;
    }


}
