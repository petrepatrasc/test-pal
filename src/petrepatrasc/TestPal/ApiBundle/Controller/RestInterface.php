<?php


namespace petrepatrasc\TestPal\ApiBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

interface RestInterface
{
    public function readAllAction();

    public function readOneAction($id);

    public function createOneAction(Request $request);

    public function updateOneAction(Request $request, $id);

    public function deleteOneAction($id);
} 