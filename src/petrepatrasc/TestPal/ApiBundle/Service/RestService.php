<?php


namespace petrepatrasc\TestPal\ApiBundle\Service;


use Doctrine\Common\Persistence\ObjectManager;

class RestService extends BaseService
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
        $entity->setDeleted(true);

        $this->manager->persist($entity);
        $this->manager->flush();

        return true;
    }
}