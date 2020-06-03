<?php

namespace TGTOf\AssistanceBundle\Controller;

use TGTOf\AssistanceBundle\Entity\Avis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
//use TGT\UserBundle\Entity\User;


/**
 * ApiAvi controller.
 *
 * @Route("ApiAvis")
 */
class ApiAvisController extends Controller
{



    /**
     * Creates a new commande entity.
     *
     * @Route("/new", name="api_avi_new")
     * @Method({"GET", "POST"})
     */
    public function newApiAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
     //   $user = $em->getRepository("Proxies\\__CG__\\UserBundle\\Entity\\User")->find($request->get('user'));
        //    $panier=$em->getRepository("AchatBundle:Panier")->findByUser_Id($user);
//        dump($user,$panier);
//        exit();


        $avi = new Avis();
      // $user = $em->getRepository('UserBundle:User')->find($request->get('user'));
      // $user = $em->getRepository("Proxies\\__CG__\\UserBundle\\Entity\\User")->find($request->get('user_id'));


        $avi->setUser(NULL);
        $avi->setDate(new \DateTime('now'));

        // $commande->setIdPanier($panier);
        //  $commande->setDate(new DateTime('now'));
        //  $commande->setEtat(false);
        $text = $request->get('texte');
        $avi->setTexte($text);
        // $tel = $request->get('tel');
        //$commande->setTel($tel);
        $em->persist($avi);
        $em->flush();




        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($avi);
        return new JsonResponse($formatted);

    }

    public function indexApiAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $avis = $em->getRepository('AssistanceBundle:Avis')->findAll();

       // $user = $em->getRepository("Proxies\\__CG__\\UserBundle\\Entity\\User")->find($request->get('user'));

   //     $commandes=$em->getRepository('AchatBundle:Commande')->findByUser_Id($user);

         $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $encoder = new JsonEncoder();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer(array($normalizer), array($encoder));
        $formatted = $serializer->normalize($avis);
        return new JsonResponse($formatted);
    }

}