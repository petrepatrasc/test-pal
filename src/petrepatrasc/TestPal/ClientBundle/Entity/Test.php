<?php


namespace petrepatrasc\TestPal\ClientBundle\Entity;

use Cegeka\SymfonyToolkitBundle\Entity\EntityBase;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="test")
 * @ORM\HasLifecycleCallbacks
 */
class Test extends EntityBase
{
    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @var string
     * @ORM\Column(type="string", name="name")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", name="permalink")
     */
    protected $permalink;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="petrepatrasc\TestPal\ClientBundle\Entity\Question", mappedBy="test", cascade={"persist", "remove"})
     */
    protected $questions;

    /**
     * @var int
     * @ORM\Column(type="integer", name="length")
     */
    protected $length;

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $permalink
     * @return $this
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;
        return $this;
    }

    /**
     * @return string
     */
    public function getPermalink()
    {
        return $this->permalink;
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

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param int $length
     * @return $this
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }


} 