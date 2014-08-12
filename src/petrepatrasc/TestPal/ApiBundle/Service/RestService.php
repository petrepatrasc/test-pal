<?php


namespace petrepatrasc\TestPal\ApiBundle\Service;


use Doctrine\Common\Persistence\ObjectManager;

class RestService
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function readAll($entityName)
    {
        return $this->manager->getRepository("TestPalApiBundle:{$entityName}")->findBy([], [
            'createdAt' => 'DESC'
        ]);
    }

    public function readOne($entityName, $criteria)
    {
        return $this->manager->getRepository("TestPalApiBundle:{$entityName}")->findOneBy($criteria);
    }

    public function updateOne($entity)
    {
        $this->manager->persist($entity);
        $this->manager->flush();

        return $entity;
    }

    public function deleteOne($entity)
    {
        $this->manager->remove($entity);
        $this->manager->flush();

        return true;
    }
}