<?php


namespace petrepatrasc\TestPal\ApiBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class QuestionRepository extends EntityRepository
{
    public function readAllByTestPermalink($permalink)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT q FROM TestPalApiBundle:Question q
            JOIN TestPalApiBundle:Test t
            WHERE q.deleted = false
            AND t.permalink = :permalink
            AND t.deleted = false
        ");

        $query->setParameter('permalink', $permalink);
        $questions = $query->getResult();

        return $questions;
    }

    public function readOneByPermalinkAndId($permalink, $id)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT q FROM TestPalApiBundle:Question q
            JOIN TestPalApiBundle:Test t
            WHERE q.id = :id
            AND q.deleted = false
            AND t.permalink = :permalink
            AND t.deleted = false
        ");

        $query->setMaxResults(1);
        $query->setParameter('id', $id);
        $query->setParameter('permalink', $permalink);

        try {
            $question = $query->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }

        return $question;
    }

    public function readOneById($id)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT q FROM TestPalApiBundle:Question q
            WHERE q.id = :id
            AND q.deleted = false
        ");

        $query->setMaxResults(1);
        $query->setParameter('id', $id);

        try {
            $question = $query->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }

        return $question;
    }
} 