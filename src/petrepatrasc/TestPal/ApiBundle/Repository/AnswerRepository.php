<?php


namespace petrepatrasc\TestPal\ApiBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class AnswerRepository extends EntityRepository
{
    public function readOneById($id)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT a
            FROM TestPalApiBundle:Answer a
            WHERE a.id = :id
            AND a.deleted = false
        ");

        $query->setMaxResults(1);
        $query->setParameter('id', $id);

        try {
            return $query->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function readAllByQuestionId($questionId)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT a
            FROM TestPalApiBundle:Answer a
            INNER JOIN TestPalApiBundle:Question q WITH q.id = a.question
            WHERE q.id = :id
            AND a.deleted = false
            AND q.deleted = false
        ");

        $query->setParameter('id', $questionId);

        return $query->getResult();
    }
} 