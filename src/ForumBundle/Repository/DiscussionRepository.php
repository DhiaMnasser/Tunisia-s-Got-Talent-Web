<?php

namespace ForumBundle\Repository;

/**
 * DiscussionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DiscussionRepository extends \Doctrine\ORM\EntityRepository
{ public function findDiscussion($id)
{
    $Query = $this->getEntityManager()->createQuery(
        "select A from ForumBundle:Discussion  A where A.post= :id"
    )->setParameter('id',$id);
    return $Query->getResult();
}
}