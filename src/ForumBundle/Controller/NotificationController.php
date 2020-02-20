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
        $notifications=$this->getDoctrine()->getManager()->getRepository('ForumBundle:Notification')->findAll();
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

}