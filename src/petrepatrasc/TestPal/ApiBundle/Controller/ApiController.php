<?hh


namespace petrepatrasc\TestPal\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use petrepatrasc\TestPal\ApiBundle\Entity\EntityBase;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends FOSRestController
{
    /**
     * Display data via formatting templates.
     *
     * @param EntityBase $data The data that should be handled.
     * @return Response
     **/
    protected function handleData(EntityBase $data): Response
    {
        $view = $this->view($data, 200);
        return $this->handleView($view);
    }
} 