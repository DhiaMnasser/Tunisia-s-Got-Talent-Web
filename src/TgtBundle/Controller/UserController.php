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
        return $this->redirectToRoute('jury_listA');
    }

    public function moveJuryAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(User::class);
        $jury=$repository->find($id);
        $jury->setJury(0);
        $em->persist($jury);
        $em->flush();
        return $this->redirectToRoute('spectateur_listA');
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(User::class);
        $user=$repository->find($id);
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('spectateur_listA');

    }

    public function newAdminAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $rep=$em->getRepository(User::class);

        $user=$rep->find($id);
        $user->setParticipant(1);
        $user->setJury(1);
        $user->setRoles(array('ROLE_ADMIN'));

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('admin_list');
    }

    public function listAdminAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(User::class);
        $admin=$rep->findBy(array('jury'=>1,'participant'=>1));

        return $this->render("@Tgt\Admin\list.html.twig",array('admin'=>$admin));
    }

    public function moveAdminAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $rep=$em->getRepository(User::class);

        $user=$rep->find($id);
        $user->setParticipant(0);
        $user->setJury(0);
        $user->setRoles(array(''));

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('admin_list');
    }

}