<?php

namespace AchatBundle\Repository;

/**
 * LigneCommandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LigneCommandeRepository extends \Doctrine\ORM\EntityRepository
{

    public  function findByProduit($id){
        /*  $query= $this->getEntityManager()->createQueryBuilder()
          ->select('p')->from('ecommerceBundle:Panier','p')->where('p.user_id= :user')->setParameter('user',"%{$user}%");

              return $query->getResult();
  */

        $query = $this->getEntityManager()->createQuery("SELECT l FROM  AchatBundle\Entity\LigneCommande AS l WHERE l.idproduit=:id ")->setParameter('id',$id);


        try {
            return $query->getOneOrNullResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }

}

    public  function findByPanier($id){
        /*  $query= $this->getEntityManager()->createQueryBuilder()
          ->select('p')->from('ecommerceBundle:Panier','p')->where('p.user_id= :user')->setParameter('user',"%{$user}%");

              return $query->getResult();
  */

        $query = $this->getEntityManager()->createQuery("SELECT l FROM  AchatBundle\Entity\LigneCommande AS l WHERE l.idPanier=:id ")->setParameter('id',$id);


        try {
            return $query->getOneOrNullResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }

    }
}
