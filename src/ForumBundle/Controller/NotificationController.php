<?php


namespace ForumBundle\Controller;

use ForumBundle\Entity\Discussion;
use ForumBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ForumBundle\Entity\Notification;
/**
 * Discussion controller.
 *
 */
class NotificationController extends Controller
{
    public function displayAction(){
        $notifications=$this->getDoctrine()->getManager()->getRepository('ForumBundle:Notification')->findBy(array(), array('date' => 'desc'));
        return $this->render('@Forum/notif/notification.html.twig', array('notifications'=>$notifications));
    }

    public function notifAction(){

        return $this->render('@Forum/notif/notifview.html.twig');
    }
    public function deleteAction($id)
    {
        $notification=$this->getDoctrine()->getRepository(Notification::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove( $notification);
        $em->flush();
        return $this->redirectToRoute("notification_show");
    }
    public function affichAction(){
        $user=$this->getUser();
        $notifications=$this->getDoctrine()->getManager()->getRepository('ForumBundle:Notification')->findBy(array('description'=>$user->getUsername(),'title'=>'nouvelle discussion a été crée sur votre post '),array('date' => 'desc'));
        return $this->render('@Forum/notif/affich.html.twig', array('notifications'=>$notifications));
    }
    public function removeAction($id)
    {
        $notification=$this->getDoctrine()->getRepository(Notification::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove( $notification);
        $em->flush();
        return $this->redirectToRoute("notification_affich");
    }
    public function countAction(){
        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository("ForumBundle:Notification")->findAll();
        $total=sizeof($discussion);
        return $this->render('@Forum/notif/count.html.twig', array(
            'nb' => $total,

        ));}
    public function countuAction(){
        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository("ForumBundle:Notification")->findBy(array('description'=>$user,'title'=>'nouvelle discussion a été crée sur votre post '),array('date' => 'desc'));;
        $total=sizeof($discussion);
        return $this->render('@Forum/notif/count.html.twig', array(
            'nb' => $total,

        ));}

}