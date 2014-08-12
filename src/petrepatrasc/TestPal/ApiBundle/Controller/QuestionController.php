<?php


namespace petrepatrasc\TestPal\ApiBundle\Controller;

use Doctrine\ORM\Mapping as ORM;

use petrepatrasc\TestPal\ApiBundle\Entity\Test;
use Symfony\Component\HttpFoundation\Request;

/**
 * @ORM\Entity()
 * @ORM\Table(name="question")
 */
class QuestionController extends BaseController
{
    const ENTITY_NAME = 'Question';

    public function readAllAction($permalink)
    {
        $questions = $this->get('testpal_question_service')->readAllByTestPermalink($permalink);

        $questions = $this->get('testpal_test_service')->scrambleQuestions($questions);
        $this->get('testpal_question_service')->scrambleAnswersForQuestionArray($questions);

        $view = $this->view($questions, 200);
        return $this->handleView($view);
    }

    public function readOneAction($id)
    {
        $question = $this->get('testpal_question_service')->readOneById($id);
        if (null === $question) {
            return $this->sendResourceNotFound();
        }

        $this->get('testpal_question_service')->scrambleAnswersForQuestionEntity($question);

        $view = $this->view($question, 200);
        return $this->handleView($view);
    }

    public function createOneAction(Request $request, $permalink)
    {
        $questionData = $request->getContent();

        /** @var Test $test */
        $test = $this->get('testpal_test_service')->readOneByPermalink($permalink);

        $question = $this->get('testpal_question_service')->deserializeQuestion($questionData);
        $question->setTest($test);

        $this->get('testpal_test_service')->updateOne($question);

        $view = $this->view($question, 201);
        return $this->handleView($view);
    }

    public function updateOneAction(Request $request, $id)
    {
        $questionData = $request->getContent();

        $parentQuestion = $this->get('testpal_question_service')->readOneById($id);
        if (null === $parentQuestion) {
            return $this->sendResourceNotFound();
        }

        $childQuestion = $this->get('testpal_question_service')->deserializeQuestion($questionData);

        $parentQuestion = $this->get('testpal_question_service')->mergeQuestionEntity($parentQuestion, $childQuestion);
        $this->get('testpal_test_service')->updateOne($parentQuestion);

        $view = $this->view($parentQuestion, 200);
        return $this->handleView($view);
    }

    public function deleteOneAction($id)
    {
        $question = $this->get('testpal_question_service')->readOneById($id);
        if (null === $question) {
            return $this->sendResourceNotFound();
        }

        $this->get('testpal_test_service')->deleteOne($question);

        $view = $this->view(null, 204);
        return $this->handleView($view);
    }
} 