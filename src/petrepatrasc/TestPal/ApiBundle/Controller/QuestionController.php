<?hh

namespace petrepatrasc\TestPal\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class QuestionController extends ApiController
{
    /**
     * Show the details of a particular question.
     *
     * @param string $id
     * @return Response
     */
    public function showAction(string $id): Response
    {
        $question = $this->get('tp.api.search.service')->findQuestionById(intval($id));
        return $this->handleData($question);
    }

    /**
     * Display all of the questions in the system belonging to a particular test.
     *
     * @param string $testId The ID of the test that the questions belong to.
     * @return Response
     */
    public function listAction(): Response
    {
        $questions = $this->get('tp.api.list.service')->listQuestions();
        return $this->handleList($questions->toArray());
    }
} 