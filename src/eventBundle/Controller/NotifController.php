<?php

namespace eventBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Notif controller.
 *
 * @Route("notif")
 */
class NotifController extends Controller
{

    /**
     * Lists all notif entities.
     *
     * @Route("/", name="notif_index")
     * @Method("GET")
     */
    public function displayAction()
    {
        $notifications = $this->getDoctrine()->getManager()->getRepository('eventBundle:Notif')->findAll() ;

        return $this->render('@event/evenement/calendrier.html.twig' , array(
            'noti' => $notifications,
        ));
    }
}
