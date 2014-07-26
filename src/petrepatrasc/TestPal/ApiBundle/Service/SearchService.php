<?hh

namespace petrepatrasc\TestPal\ApiBundle\Service;


use Doctrine\Common\Persistence\ObjectManager;
use petrepatrasc\TestPal\ApiBundle\Entity\Question;

class SearchService
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
     * @param int $id
     * @return Question
     */
    public function findQuestionById(int $id): ?Question
    {
        return $this->manager->getRepository('TestPalApiBundle:Question')->find($id);
    }
} 