<?php


namespace EvaluationBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\Security;

class SecurityController extends Controller
{
    public function addAction()
    {
        $userManager=$this->container->get('fos_user.user_manager');

        $user= $userManager->createUser();
        $user->setUsername('newUSerByUM');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setEmail('newUser@gmail.com');
        $user->setPlainPassword('userPassword');
        $user->setEnabled(true);
    }
    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');

        if($authChecker->isGranted('ROLE_AMIN'))
        {
            return $this->render('@Evaluation\Security\admin_home.html.twig');
        }elseif ($authChecker->isGranted('ROLE_USER'))
        {
            return $this->render('@Evaluation\Security\user_home.html.twig');
        }else
            {
                return $this->render('@FOSUser/Security/login_content.html.twig');
            }
    }
}