<?hh


namespace petrepatrasc\TestPal\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question extends EntityBase
{
    /**
     * @var string
     * @ORM\Column(type="string", name="title")
     */
    protected string $title;

    /**
     * @var string
     * @ORM\Column(type="string", name="content")
     */
    protected string $content;

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): Question
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): Question
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }


} 