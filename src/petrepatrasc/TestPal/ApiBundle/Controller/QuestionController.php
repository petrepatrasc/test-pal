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
        $questions = $this->get('testpal.api.question.service')->readAllByTestPermalink($permalink);

//        $questions = $this->get('testpal.api.test.service')->scrambleQuestions($questions);
//        $this->get('testpal.api.question.service')->scrambleAnswersForQuestionArray($questions);

        return $this->sendResponse($questions);
    }

    public function readOneAction($id)
    {
        $question = $this->get('testpal.api.question.service')->readOneById($id);
        if (null === $question) {
            return $this->sendResourceNotFound();
        }

        $this->get('testpal.api.question.service')->scrambleAnswersForQuestionEntity($question);

        return $this->sendResponse($question);
    }

    public function createOneAction(Request $request, $permalink)
    {
        $questionData = $request->getContent();

        /** @var Test $test */
        $test = $this->get('testpal.api.test.service')->readOneByPermalink($permalink);

        $question = $this->get('testpal.api.question.service')->deserializeQuestion($questionData);
        $question->setTest($test);

        $this->get('testpal.api.question.service')->updateOne($question);

        return $this->sendResponse($question, 201);
    }

    public function updateOneAction(Request $request, $id)
    {
        $questionData = $request->getContent();

        $parentQuestion = $this->get('testpal.api.question.service')->readOneById($id);
        if (null === $parentQuestion) {
            return $this->sendResourceNotFound();
        }

        $childQuestion = $this->get('testpal.api.question.service')->deserializeQuestion($questionData);

        $parentQuestion = $this->get('testpal.api.question.service')->mergeQuestionEntity($parentQuestion, $childQuestion);
        $this->get('testpal.api.question.service')->updateOne($parentQuestion);

        return $this->sendResponse($parentQuestion, 200);
    }

    public function deleteOneAction($id)
    {
        $question = $this->get('testpal.api.question.service')->readOneById($id);
        if (null === $question) {
            return $this->sendResourceNotFound();
        }

        $this->get('testpal.api.question.service')->deleteOne($question);

        return $this->sendResponse(null, 204);
    }

    public function setCorrectAnswerAction($questionId, $answerId)
    {
        $question = $this->get('testpal.api.question.service')->readOneById($questionId);
        $answer = $this->get('testpal.api.answer.service')->readOneById($answerId);

        if (null === $question || null === $answer) {
            return $this->sendResourceNotFound();
        }

        $question->setCorrectAnswer($answer);
        $this->get('testpal.api.question.service')->updateOne($question);

        return $this->sendResponse($question);
    }
} 