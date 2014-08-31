<?php


namespace petrepatrasc\TestPal\ApiBundle\Controller;


use petrepatrasc\TestPal\ApiBundle\Entity\Examination;
use Symfony\Component\HttpFoundation\Request;

class ExaminationController extends BaseController
{
    public function startExaminationAction(Request $request)
    {
        $candidateName = $request->get('candidateName');

        if (null === $candidateName) {
            return $this->sendInvalidArguments('Invalid candidate name');
        }

        $testPermalink = $request->get('testPermalink');
        $test = $this->get('testpal.api.test.service')->readOneByPermalink($testPermalink);

        if (null === $test) {
            return $this->sendInvalidArguments('Invalid test permalink');
        }

        $examinationEndTime = $this->get('testpal.api.examination.service')->getTestEndTime($test);
        $examinationUserKey = $this->get('testpal.api.examination.service')->generateUserKey();

        $examination = new Examination();
        $examination->setTest($test)
            ->setCandidateName($candidateName)
            ->setEndTime($examinationEndTime)
            ->setUserKey($examinationUserKey);

        $this->get('testpal.api.rest.service')->updateOne($examination);

        return $this->sendResponse($examination);
    }
} 