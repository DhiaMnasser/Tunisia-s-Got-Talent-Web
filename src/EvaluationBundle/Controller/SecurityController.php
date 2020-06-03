<?php


namespace EvaluationBundle\Controller;


use AchatBundle\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\Security;

class SecurityController extends Controller
{

    public function addAction()
    {
        $userManager=$this->container->get('fos_user.user_manager');

        $user= $userManager->createUser();

        $user->setUsername('gthAdmin');
        $user->setRoles(array('ROLE_SUPER_ADMIN'));
        $user->setEmail('admin@admin.com');
        $user->setPlainPassword('gth');
        $user->setEnabled(true);
        $userManager->updateUser($user);



        return $this->forward('EvaluationBundle:Security:redirect');
    }
    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');

        if($authChecker->isGranted('ROLE_SUPER_ADMIN'))
        {
            return $this->redirectToRoute('publication_statRA');
        }elseif ($authChecker->isGranted('ROLE_USER'))
        {
            return $this->redirectToRoute('publication_list');
        }else
            {
                return $this->render('@FOSUser/Security/login_content.html.twig');
            }
    }
}