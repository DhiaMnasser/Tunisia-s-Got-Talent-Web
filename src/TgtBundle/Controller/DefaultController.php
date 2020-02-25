<?php

namespace TgtBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Tgt/Default/index.html.twig');
    }
}
