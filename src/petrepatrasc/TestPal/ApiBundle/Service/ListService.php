<?hh


namespace petrepatrasc\TestPal\ApiBundle\Service;


use Doctrine\Common\Persistence\ObjectManager;
use petrepatrasc\TestPal\ApiBundle\Entity\Question;

class ListService
{
    /**
     * @var ObjectManager
     */
    protected ObjectManager $manager;

    public function __construct(ObjectManager $manager): void
    {
        $this->manager = $manager;
    }

    /**
     * @return Set<Question>
     */
    public function listQuestions(): Vector<Question>
    {
        $results = $this->manager->getRepository('TestPalApiBundle:Question')->findAll();
        return Vector<Question>::fromArray($results);
    }
} 