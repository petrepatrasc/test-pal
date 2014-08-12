<?php


namespace petrepatrasc\TestPal\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use petrepatrasc\TestPal\ApiBundle\Entity\Test;
use Symfony\Component\HttpFoundation\Request;

class TestController extends BaseController implements RestInterface
{
    const ENTITY_NAME = 'Test';

    public function readAllAction()
    {
        $tests = $this->get('testpal_test_service')->readAll(self::ENTITY_NAME);

        return $this->sendResponse($tests);
    }

    public function readOneAction($permalink)
    {
        $test = $this->get('testpal_test_service')->readOneByPermalink($permalink);

        if (null === $test) {
            return $this->sendResourceNotFound();
        }

        return $this->sendResponse($test);
    }

    public function createOneAction(Request $request)
    {
        $testData = $request->getContent();

        $test = $this->get('testpal_test_service')->deserializeTest($testData);
        $test->setPermalink($this->get('testpal_test_service')->generatePermalink($test->getName()));

        $test = $this->get('testpal_test_service')->updateOne($test);

        return $this->sendResponse($test, 201);
    }

    public function updateOneAction(Request $request, $permalink)
    {
        $testData = $request->getContent();

        $parentEntity = $this->get('testpal_test_service')->readOneByPermalink($permalink);
        if (null === $parentEntity) {
            return $this->sendResourceNotFound();
        }

        $childEntity = $this->get('testpal_test_service')->deserializeTest($testData);

        $parentEntity = $this->get('testpal_test_service')->mergeTestEntity($parentEntity, $childEntity);
        $parentEntity = $this->get('testpal_test_service')->updateOne($parentEntity);

        return $this->sendResponse($parentEntity, 200);
    }

    public function deleteOneAction($permalink) {
        $test = $this->get('testpal_test_service')->readOneByPermalink($permalink);

        if (null === $test) {
            return $this->sendResourceNotFound();
        }

        $this->get('testpal_test_service')->deleteOne($test);

        return $this->sendResponse(null, 204);
    }
}