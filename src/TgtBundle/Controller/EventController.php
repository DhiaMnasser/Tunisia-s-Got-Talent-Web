<?php


namespace TgtBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TgtBundle\Entity\Evenement;
use TgtBundle\Form\EvenementType;

class EventController extends Controller
{
    public function addAction(Request $request)
    {
        $event=new Evenement();
        $form=$this->createForm(EvenementType::class,$event);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('event_list');
        }
        return $this->render('@Tgt\Event\create.html.twig',array('form'=>$form->createView()));
    }
    public function listAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(Evenement::class);
        $events=$rep->findAll();

        return $this->render("@Tgt\Event\list.html.twig",array('events'=>$events));
    }
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(Evenement::class);
        $event=$repository->find($id);
        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('event_list');

    }
}