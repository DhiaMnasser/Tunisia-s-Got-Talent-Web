<?php


namespace EvaluationBundle\Controller;


use EvaluationBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EvaluationBundle\Entity\Commentaire;
use EvaluationBundle\Form\CommentaireType;

class CommentaireController extends Controller
{
    public function addAction(Request $request,$id)
    {
        $com=new Commentaire();
        $pub=$this->getDoctrine()->getRepository(Publication::class)->find($id);

        $form=$this->createForm(CommentaireType::class,$com);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $com->setAuthor($this->getUser()->getUsername());
            $em=$this->getDoctrine()->getManager();
            $em->persist($com);
            $em->flush();

            return $this->redirectToRoute('publication_comment',['id'=> $pub]);
        }

        $coms=$this->getDoctrine()->getRepository()->myGetComment($id);
        return $this->render('@Evaluation\Publication\pubComment.html.twig',array('form_com'=>$form->createView(),'coms'=>$coms));

    }
}