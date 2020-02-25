<?php


namespace EvaluationBundle\Controller;


use EvaluationBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EvaluationBundle\Form\PublicationType;
use EvaluationBundle\Entity\Publication;
use FOS\UserBundle\Doctrine\UserManager as FOS;


class PublicationController extends Controller
{
    public function listAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(Publication::class);
        $pubs=$rep->findAll();

        return $this->render("@Evaluation\Publication\list.html.twig",array('pubs'=>$pubs));
    }


    public function upAction(Request $request)
    {
        $pub=new Publication();
        $form=$this->createForm(PublicationType::class,$pub);
        $form->handleRequest($request);
        $user=$this->getUser()->getUsername();

        //$this->get('upload.annotation_reader')->isUploadable($pub);
        if($form->isSubmitted() && $form->isValid())
        {
            $pub->setAuthor($user);
            $em=$this->getDoctrine()->getManager();
            $em->persist($pub);
            $em->flush();

            return $this->redirectToRoute('publication_list');
        }
        return $this->render('@Evaluation\Publication\upload.html.twig',array('form'=>$form->createView()));
    }

    public  function editAction(Request $request,$id)
    {
        $publication=$this->getDoctrine()->getRepository(Publication::class)->find($id);
        $editForm = $this->createForm(PublicationType::class,$publication);
        $editForm->
        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid())
        {
            $publication->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('publication/edit/{id}',array('id'=>$publication->getId()));
        }

        return $this->render('publication/edit',array(
            'publication' => $publication,
            'edit_form'=> $editForm->createView()
        ));
    }

    public function commentPubAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $pub=$em->getRepository(Publication::class)->find($id);
        $coms=$em->getRepository(Commentaire::class)->myGetComment($id);

        return $this->render("@Evaluation\Publication\pubComment.html.twig",array('pub'=>$pub,'coms'=>$coms));
    }
}