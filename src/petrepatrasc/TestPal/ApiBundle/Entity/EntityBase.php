<?hh


namespace petrepatrasc\TestPal\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 * @JMS\ExclusionPolicy("all")
 */
class EntityBase
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    protected int $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at", nullable=true)
     */
    protected \DateTime $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     */
    protected \DateTime $updatedAt;

    /** @ORM\PrePersist */
    public function prePersistHook(): void
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }

    /** @ORM\PreUpdate */
    public function preUpdateHook(): void
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt): EntityBase
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt): EntityBase
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
} 