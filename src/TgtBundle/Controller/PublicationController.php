<?php


namespace TgtBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TgtBundle\Entity\Publication;
use TgtBundle\Form\PublicationType;

class PublicationController extends Controller
{
    public function listNVAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(Publication::class);
        $pubs=$rep->findAll();

        return $this->render("@Tgt\Publication\listNV.html.twig",array('pubs'=>$pubs));
    }
    public function listAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(Publication::class);
        $pubs=$rep->findAll();

        return $this->render("@Tgt\Publication\list.html.twig",array('pubs'=>$pubs));
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(Publication::class);
        $event=$repository->find($id);
        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('publication_listV');

    }

    public function valideAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(Publication::class);
        $pub=$repository->find($id);
        $pub->setValide(1);
        $em->persist($pub);
        $em->flush();
        return $this->redirectToRoute('publication_listV');
    }

    public function addAction(Request $request)
    {
        $pub=new Publication();
        $form=$this->createForm(PublicationType::class,$pub);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($pub);
            $em->flush();

            return $this->redirectToRoute('publication_list');
        }
        return $this->render('@Tgt\Publication\add.html.twig',array('form'=>$form->createView()));
    }

    public function statAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(Publication::class);
        $stat=$rep->myStat();

        return $this->render("@Tgt\Statistique\listR.html.twig",array('stat'=>$stat));
    }

    public function statGAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(Publication::class);
        $stat=$rep->findBy(array('valide'=>1));

        return $this->render("@Tgt\Statistique\listG.html.twig",array('stat'=>$stat));
    }
}