<?php


namespace petrepatrasc\TestPal\ApiBundle\Controller;


interface RestInterface
{
    public function readAllAction();

    public function readOneAction($id);

    public function createOneAction();

    public function updateOneAction($id);

    public function deleteOneAction($id):
} 