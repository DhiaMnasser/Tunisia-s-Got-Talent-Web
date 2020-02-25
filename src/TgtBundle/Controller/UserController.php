<?php


namespace TgtBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TgtBundle\Entity\User;

class UserController extends Controller
{

    public function listJuryAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(User::class);
        $jury=$rep->findBy(array('jury'=>1,'participant'=>0));

        return $this->render("@Tgt\Jury\list.html.twig",array('jury'=>$jury));
    }

    public function listParticipantAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(User::class);
        $part=$rep->findBy(array('jury'=>0,'participant'=>1));

        return $this->render("@Tgt\Participant\list.html.twig",array('part'=>$part));
    }

    public function listSpectateurAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(User::class);
        $spec=$rep->findBy(array('jury'=>0,'participant'=>0));

        return $this->render("@Tgt\Spectateur\list.html.twig",array('specs'=>$spec));
    }

    public function newJuryAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(User::class);
        $jury=$repository->find($id);
        $jury->setJury(1);
        $em->persist($jury);
        $em->flush();
        return $this->redirectToRoute('jury_list');
    }

    public function moveJuryAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(User::class);
        $jury=$repository->find($id);
        $jury->setJury(0);
        $em->persist($jury);
        $em->flush();
        return $this->redirectToRoute('spectateur_list');
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(User::class);
        $user=$repository->find($id);
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('spectateur_list');

    }

    public function redirectAction()
    {

    }


}