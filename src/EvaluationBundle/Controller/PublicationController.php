<?php


namespace EvaluationBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EvaluationBundle\Form\PublicationType;
use EvaluationBundle\Entity\Publication;

class PublicationController extends Controller
{
    public function listAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(Publication::class);
        $pubs=$rep->findAll();

        return $this->render("@Evaluation\Publication\list.html.twig",array('pubs'=>$pubs));
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(Publication::class);
        $event=$repository->find($id);
        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('publication_list');

    }

    public function upAction(Request $request)
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
        return $this->render('@Evaluation\Publication\upload.html.twig',array('form'=>$form->createView()));
    }
}