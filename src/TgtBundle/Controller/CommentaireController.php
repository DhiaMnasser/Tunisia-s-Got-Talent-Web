<?php


namespace TgtBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TgtBundle\Entity\Commentaire;
use TgtBundle\Form\CommentaireType;

class CommentaireController extends Controller
{
    public function addAction(Request $request)
    {
        $com=new Commentaire();
        $form=$this->createForm(CommentaireType::class,$com);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($com);
            $em->flush();

            return $this->redirectToRoute('commentaire_list');
        }
        return $this->render('@Tgt\Commentaire\add.html.twig',array('form'=>$form->createView()));
    }
    public function listAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(Commentaire::class);
        $coms=$rep->findBy(array('Publication' => 'DESC'));

        return $this->render("@Tgt\Commentaire\list.html.twig",array('coms'=>$coms));
    }
}