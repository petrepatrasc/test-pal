<?php


namespace petrepatrasc\TestPal\ApiBundle\Controller;

use Doctrine\ORM\Mapping as ORM;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\Serializer as JMS;

use petrepatrasc\TestPal\ApiBundle\Entity\Test;
use Symfony\Component\HttpFoundation\Request;

/**
 * @ORM\Entity()
 * @ORM\Table(name="question")
 */
class QuestionController extends FOSRestController
{
    const ENTITY_NAME = 'Question';

    public function readAllAction($permalink)
    {
        $test = $this->get('testpal_rest_service')->readOne(TestController::ENTITY_NAME, [
            'permalink' => $permalink,
        ]);

        $questions = $this->get('testpal_test_service')->scrambleQuestions($test);
        $this->get('testpal_question_service')->scrambleAnswersForQuestionCollection($questions);

        $view = $this->view($questions, 200);
        return $this->handleView($view);
    }

    public function readOneAction($permalink, $id)
    {
        $question = $this->get('testpal_question_service')->readOne($permalink, $id);
        $this->get('testpal_question_service')->scrambleAnswersForQuestionEntity($question);

        $view = $this->view($question, 200);
        return $this->handleView($view);
    }

    public function createOneAction(Request $request, $permalink)
    {
        $questionData = $request->getContent();

        /** @var Test $test */
        $test = $this->get('testpal_rest_service')->readOne(TestController::ENTITY_NAME, [
            'permalink' => $permalink,
        ]);
        $question = $this->get('testpal_question_service')->deserializeQuestion($questionData);
        $question->setTest($test);

        $this->get('testpal_rest_service')->updateOne($question);

        $view = $this->view($question, 201);
        return $this->handleView($view);
    }

    public function updateOneAction(Request $request, $permalink, $id)
    {
        $questionData = $request->getContent();

        /** @var Test $test */
        $test = $this->get('testpal_rest_service')->readOne(TestController::ENTITY_NAME, [
            'permalink' => $permalink,
        ]);

        $parentQuestion = $this->get('testpal_question_service')->readOne($permalink, $id);
        $childQuestion = $this->get('testpal_question_service')->deserializeQuestion($questionData);

        $parentQuestion = $this->get('testpal_question_service')->mergeQuestionEntity($parentQuestion, $childQuestion);
        $this->get('testpal_rest_service')->updateOne($parentQuestion);

        $view = $this->view($parentQuestion, 200);
        return $this->handleView($view);
    }

    public function deleteOneAction($permalink, $id)
    {
        $question = $this->get('testpal_question_service')->readOne($permalink, $id);
        $this->get('testpal_rest_service')->deleteOne($question);

        $view = $this->view(null, 204);
        return $this->handleView($view);
    }
} 