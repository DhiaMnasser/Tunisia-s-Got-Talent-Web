<?php

namespace ForumBundle\Repository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{public function findPost($id)
{
    $Query = $this->getEntityManager()->createQuery(
        "select A from ForumBundle:Post  A where A.user= :id"
    )->setParameter('id',$id);
    return $Query->getResult();
}

}