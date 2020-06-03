<?php


namespace EvaluationBundle\Controller;


use EvaluationBundle\Entity\Publication;
use EvaluationBundle\Entity\Vote;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
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
    public function vote2Action($id,$idUser)
    {
        $vote= new Vote();
        $em=$this->getDoctrine()->getManager();
        $pub=$em->getRepository(Publication::class)->find($id);


        $pub->setNbrVote($pub->getNbrVote()+1);


        $vote->setPublication($id);
        $vote->setUser($idUser);

        $em->persist($vote);
        $em->flush();


    }

    public function verifApiAction($id){
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(Vote::class);
        $user=$repository->findOneByUser($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }

    public function allAction()
    {
        $tasks =$this->getDoctrine()->getManager()
            ->getRepository('EvaluationBundle:Vote')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

}