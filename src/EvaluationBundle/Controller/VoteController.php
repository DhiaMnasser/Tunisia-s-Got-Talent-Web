<?php


namespace EvaluationBundle\Controller;


use EvaluationBundle\Entity\Publication;
use EvaluationBundle\Entity\Vote;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class VoteController extends Controller
{

    public function voteAction($id)
    {
        $vote= new Vote();
        $em=$this->getDoctrine()->getManager();
        $pub=$em->getRepository(Publication::class)->find($id);

        //recuperation du username du user courant (car unique)
        $userName=$this->getUser()->getUsername();

        //recherche de son id à travers la classe User créée
        $userN=$em->getRepository(User::class)->findOneBy(array('username'=>$userName));
        $userId=$userN->getId();

        $verifVote=$em->getRepository(Vote::class)->findOneBy(array('user'=>$userId,'publication'=>$id));


        if( $verifVote==null )
        {
            if($userN->isJury()==true and $userN->isParticipant()==false)
            {
                $pub->setNbrVote($pub->getNbrVote()+3);
            }
            if($userN->isJury()==false and $userN->isParticipant()==true)
            {
                $pub->setNbrVote($pub->getNbrVote()+1);
            }
            if($userN->isJury()==false and $userN->isParticipant()==false)
            {
                $pub->setNbrVote($pub->getNbrVote()+1);
            }
        }else{
            return $this->render('@Evaluation/Vote/deja.html.twig');
        }

        $vote->setPublication($id);
        $vote->setUser($userId);

        $em->persist($vote);
        $em->flush();

        return $this->redirectToRoute('publication_comment', ['id' => $id]);

    }

}