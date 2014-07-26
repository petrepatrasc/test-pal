<?hh


namespace petrepatrasc\TestPal\ApiBundle\Tests\Integration;


use Cegeka\SymfonyToolkitBundle\Test\IntegrationBase;
use petrepatrasc\TestPal\ApiBundle\Service\SearchService;

class SearchServiceTest extends IntegrationBase
{
    /**
     * @var SearchService
     */
    protected SearchService $searchService;

    public function setUp(): void
    {
        parent::setUp();

        $this->searchService = static::$kernel->getContainer()->get('tp.api.search.service');
    }

    public function testFindQuestionById(): void
    {
        $question = $this->searchService->findQuestionById(1);

        $this->assertNotNull($question);
        $this->assertNotNull($question->getId());
    }
} 