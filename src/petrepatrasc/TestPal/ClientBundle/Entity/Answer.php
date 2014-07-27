<?php


namespace petrepatrasc\TestPal\ClientBundle\Entity;

use Cegeka\SymfonyToolkitBundle\Entity\EntityBase;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="answer")
 * @ORM\HasLifecycleCallbacks
 */
class Answer extends EntityBase
{
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


} 