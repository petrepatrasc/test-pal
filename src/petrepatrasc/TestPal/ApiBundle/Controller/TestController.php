<?php


namespace petrepatrasc\TestPal\ApiBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

class TestController extends BaseController implements RestInterface
{
    const ENTITY_NAME = 'Test';

    public function readAllAction()
    {
        $tests = $this->get('testpal.api.test.service')->readAll(self::ENTITY_NAME);

        return $this->sendResponse($tests);
    }

    public function readOneAction($permalink)
    {
        $test = $this->get('testpal.api.test.service')->readOneByPermalink($permalink);

        if (null === $test) {
            return $this->sendResourceNotFound();
        }

        return $this->sendResponse($test);
    }

    public function createOneAction(Request $request)
    {
        $testData = $request->getContent();

        $test = $this->get('testpal.api.test.service')->deserializeTest($testData);
        $test->setPermalink($this->get('testpal.api.test.service')->generatePermalink($test->getName()));

        $test = $this->get('testpal.api.test.service')->updateOne($test);

        return $this->sendResponse($test, 201);
    }

    public function updateOneAction(Request $request, $permalink)
    {
        $testData = $request->getContent();

        $parentEntity = $this->get('testpal.api.test.service')->readOneByPermalink($permalink);
        if (null === $parentEntity) {
            return $this->sendResourceNotFound();
        }

        $childEntity = $this->get('testpal.api.test.service')->deserializeTest($testData);

        $parentEntity = $this->get('testpal.api.test.service')->mergeTestEntity($parentEntity, $childEntity);
        $parentEntity = $this->get('testpal.api.test.service')->updateOne($parentEntity);

        return $this->sendResponse($parentEntity, 200);
    }

    public function deleteOneAction($permalink) {
        $test = $this->get('testpal.api.test.service')->readOneByPermalink($permalink);

        if (null === $test) {
            return $this->sendResourceNotFound();
        }

        $this->get('testpal.api.test.service')->deleteOne($test);

        return $this->sendResponse(null, 204);
    }
}