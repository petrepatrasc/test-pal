<?php


namespace petrepatrasc\TestPal\ClientBundle\Entity;

use Cegeka\SymfonyToolkitBundle\Entity\EntityBase;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="answer")
 */
class Answer extends EntityBase
{
    /**
     * @var string
     * @ORM\Column(type="text", name="content")
     */
    protected $content;

    /**
     * @var string
     * @ORM\Column(type="string", name="identifier")
     */
    protected $assignedIdentifier;

    /**
     * @param string $assignedIdentifier
     * @return $this
     */
    public function setAssignedIdentifier($assignedIdentifier)
    {
        $this->assignedIdentifier = $assignedIdentifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getAssignedIdentifier()
    {
        return $this->assignedIdentifier;
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


} 