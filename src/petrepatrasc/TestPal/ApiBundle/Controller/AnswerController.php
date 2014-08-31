<?php


namespace petrepatrasc\TestPal\ApiBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

class AnswerController extends BaseController
{
    public function readAllAction($questionId)
    {
        $answers = $this->get('testpal.api.answer.service')->readAllByQuestionId($questionId);
        shuffle($answers);

        return $this->sendResponse($answers);
    }

    public function readOneAction($id)
    {
        $answer = $this->get('testpal.api.answer.service')->readOneById($id);

        if (null === $answer) {
            return $this->sendResourceNotFound();
        }

        return $this->sendResponse($answer);
    }

    public function createOneAction(Request $request, $questionId)
    {
        $answerData = $request->getContent();

        $question = $this->get('testpal.api.question.service')->readOneById($questionId);
        $answer = $this->get('testpal.api.answer.service')->deserializeAnswer($answerData);
        $answer->setQuestion($question);

        $this->get('testpal.api.answer.service')->updateOne($answer);

        return $this->sendResponse($question, 201);
    }

    public function updateOneAction(Request $request, $id)
    {
        $answerData = $request->getContent();

        $parentAnswer = $this->get('testpal.api.answer.service')->readOneById($id);
        if (null === $parentAnswer) {
            return $this->sendResourceNotFound();
        }

        $childAnswer = $this->get('testpal.api.answer.service')->deserializeAnswer($answerData);
        $parentAnswer = $this->get('testpal.api.answer.service')->mergeAnswerEntity($parentAnswer, $childAnswer);

        $this->get('testpal.api.answer.service')->updateOne($parentAnswer);

        return $this->sendResponse($parentAnswer, 200);
    }

    public function deleteOneAction($id)
    {
        $answer = $this->get('testpal.api.answer.service')->readOneById($id);
        if (null === $answer) {
            return $this->sendResourceNotFound();
        }

        $this->get('testpal.api.answer.service')->deleteOne($answer);

        return $this->sendResponse(null, 204);
    }
} 