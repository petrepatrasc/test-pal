<?php


namespace petrepatrasc\TestPal\ApiBundle\Tests\Functional\Controller;


class TestControllerTest extends BaseControllerHelper
{
    public function testReadAll()
    {
        $results = $this->navigateToUrl('/api/tests', 'GET');
        $this->assertNotNull($results);

        $testFixtureFound = false;
        foreach ($results as $result) {
            if ('Senior PHP Developer' !== $result->name) {
                continue;
            }

            $this->assertNotNull($result->permalink);
            $this->assertNotNull($result->id);
            $this->assertNotNull($result->created_at);
            $this->assertNotNull($result->updated_at);
            $this->assertInternalType('string', $result->name);
            $this->assertInternalType('string', $result->permalink);
            $this->assertInternalType('int', $result->length);

            $testFixtureFound = true;
        }

        $this->assertTrue($testFixtureFound, 'None of the expected results were in the array provided.');
    }

    public function testReadOne()
    {
        $this->readOne('senior-php-developer-318', 1, 'Senior PHP Developer', 60);
    }

    private function createOne($name, $length)
    {
        $testObject = new \stdClass();
        $testObject->name = $name;
        $testObject->length = $length;
        $testObject = json_encode($testObject);

        $result = $this->postJson('/api/tests', 'POST', $testObject);
        $this->assertNotNull($result);
        $this->assertNotNull($result->permalink);

        return $result;
    }

    private function readOne($permalink, $id, $name, $length)
    {
        $result = $this->navigateToUrl('/api/tests/' . $permalink, 'GET');

        $this->assertNotNull($result);
        $this->assertEquals($id, $result->id);
        $this->assertEquals($name, $result->name);
        $this->assertEquals($permalink, $result->permalink);
        $this->assertEquals($length, $result->length);

        $this->assertInternalType('string', $result->name);
        $this->assertInternalType('string', $result->permalink);
        $this->assertInternalType('int', $result->id);
        $this->assertInternalType('int', $result->length);
    }

    private function updateOne($permalink, $name, $length)
    {
        $testObject = new \stdClass();
        $testObject->name = $name;
        $testObject->length = $length;
        $testObject = json_encode($testObject);

        $result = $this->postJson('/api/tests/' . $permalink, 'PUT', $testObject);
        $this->assertNotNull($result);
        $this->assertNotNull($result->permalink);

        return $result;
    }

    public function testCreateOne()
    {
        $name = 'Test Data';
        $length = 671;

        $result = $this->createOne($name, $length);
        $this->readOne($result->permalink, $result->id, $name, $length);
    }

    public function testUpdateOne()
    {
        $createdEntry = $this->createOne('Update test', 200);
        $this->readOne($createdEntry->permalink, $createdEntry->id, 'Update test', 200);

        $updatedEntry = $this->updateOne($createdEntry->permalink, 'New update name', 234);
        $this->readOne($updatedEntry->permalink, $updatedEntry->id, 'New update name', 234);
    }

    public function testDeleteOne()
    {
        $createdEntry = $this->createOne('Delete test', 120);
        $this->readOne($createdEntry->permalink, $createdEntry->id, 'Delete test', 120);

        $this->navigateToUrl('/api/tests/' . $createdEntry->permalink, 'DELETE');
        $this->navigateToUrl('/api/tests/' . $createdEntry->permalink, 'GET', false);
    }
} 