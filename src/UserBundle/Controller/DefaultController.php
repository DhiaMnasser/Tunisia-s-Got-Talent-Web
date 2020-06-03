<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@User/Default/index.html.twig');
    }
    public function userAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('UserBundle:User')->findAll();

        return $this->render('@User/default/user.html.twig', array(
            'posts' => $posts,
        ));
    }
}
