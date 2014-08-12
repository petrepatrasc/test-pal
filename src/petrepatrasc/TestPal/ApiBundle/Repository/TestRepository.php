<?php


namespace petrepatrasc\TestPal\ApiBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class TestRepository extends EntityRepository
{
    public function readAll()
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT t
            FROM TestPalApiBundle:Test t
            WHERE t.deleted = false
            ORDER BY t.createdAt DESC
        ");

        return $query->getResult();
    }

    public function readOneByPermalink($permalink)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT t
            FROM TestPalApiBundle:Test t
            WHERE t.permalink = :permalink
            AND t.deleted = false
        ");

        $query->setMaxResults(1);
        $query->setParameter('permalink', $permalink);

        try {
            return $query->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }
} 