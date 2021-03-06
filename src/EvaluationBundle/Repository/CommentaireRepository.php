<?php

namespace EvaluationBundle\Repository;

/**
 * CommentaireRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentaireRepository extends \Doctrine\ORM\EntityRepository
{
    public function myGetComment($id)
    {
        $ql=$this->getEntityManager()
            ->createQuery("SELECT c FROM EvaluationBundle:Commentaire c where c.publication= :id ORDER BY c.dateC DESC")
            ->setParameter('id',$id);
        return $ql->getResult();
    }
}
