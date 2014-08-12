<?php


namespace petrepatrasc\TestPal\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use petrepatrasc\TestPal\ApiBundle\Entity\Test;
use Symfony\Component\HttpFoundation\Request;

class TestController extends FOSRestController implements RestInterface
{
    const ENTITY_NAME = 'Test';

    public function readAllAction()
    {
        $tests = $this->get('testpal_rest_service')->readAll(self::ENTITY_NAME);

        $view = $this->view($tests, 200);
        return $this->handleView($view);
    }

    public function readOneAction($permalink)
    {
        $test = $this->get('testpal_rest_service')->readOne(self::ENTITY_NAME, [
            'permalink' => $permalink,
        ]);

        $view = $this->view($test, 200);
        return $this->handleView($view);
    }

    public function createOneAction(Request $request)
    {
        $testData = $request->getContent();

        $test = $this->get('testpal_test_service')->deserializeTest($testData);
        $test->setPermalink($this->get('testpal_test_service')->generatePermalink($test->getName()));
        $test = $this->get('testpal_rest_service')->updateOne($test);

        $view = $this->view($test, 201);
        return $this->handleView($view);
    }

    public function updateOneAction(Request $request, $permalink)
    {
        $testData = $request->getContent();

        $parentEntity = $this->get('testpal_rest_service')->readOne(self::ENTITY_NAME, [
            'permalink' => $permalink
        ]);
        $childEntity = $this->get('testpal_test_service')->deserializeTest($testData);

        $parentEntity = $this->get('testpal_test_service')->mergeTestEntity($parentEntity, $childEntity);
        $parentEntity = $this->get('testpal_rest_service')->updateOne($parentEntity);

        $view = $this->view($parentEntity, 200);
        return $this->handleView($view);
    }

    public function deleteOneAction($permalink) {
        $test = $this->get('testpal_rest_service')->readOne(self::ENTITY_NAME, [
            'permalink' => $permalink,
        ]);

        $this->get('testpal_rest_service')->deleteOne($test);

        $view = $this->view(null, 204);
        return $this->handleView($view);
    }
}