<?php

namespace Gth\UploadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GthUploadBundle:Default:index.html.twig');
    }
}
