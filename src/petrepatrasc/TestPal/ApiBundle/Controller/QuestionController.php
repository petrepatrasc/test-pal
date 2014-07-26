<?hh

namespace petrepatrasc\TestPal\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class QuestionController extends ApiController
{
    /**
     * @param string $id
     * @return Response
     */
    public function showAction(string $id): Response
    {
        $question = $this->get('tp.api.search.service')->findQuestionById(intval($id));
        return $this->handleData($question);
    }
} 