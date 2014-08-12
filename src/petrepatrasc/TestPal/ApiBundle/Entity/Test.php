<?php


namespace petrepatrasc\TestPal\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Cegeka\SymfonyToolkitBundle\Entity\EntityBase;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity()
 * @ORM\Table(name="test")
 * @JMS\ExclusionPolicy("all")
 */
class Test extends EntityBase
{
    /**
     * @var string
     * @ORM\Column(type="string")
     * @JMS\Type("string")
     * @JMS\Expose()
     * @JMS\XmlElement(cdata=false)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @JMS\Type("string")
     * @JMS\Expose()
     * @JMS\XmlElement(cdata=false)
     */
    protected $permalink;

    /**
     * @var int
     * @ORM\Column(type="integer")
     * @JMS\Type("integer")
     * @JMS\Expose()
     * @JMS\XmlElement(cdata=false)
     */
    protected $length;

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


} 