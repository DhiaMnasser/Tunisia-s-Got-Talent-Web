<?php


namespace EvaluationBundle\Controller;


use EvaluationBundle\Entity\Commentaire;
use EvaluationBundle\Entity\Vote;
use EvaluationBundle\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use EvaluationBundle\Form\PublicationType;
use EvaluationBundle\Entity\Publication;
use FOS\UserBundle\Doctrine\UserManager as FOS;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TgtBundle\Entity\User;


class PublicationController extends Controller
{
    public function listAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(Publication::class);
        $pubs=$rep->findAll();

        return $this->render("@Evaluation\Publication\list.html.twig",array('pubs'=>$pubs));
    }


    public function upAction(Request $request)
    {
        $pub=new Publication();
        $form=$this->createForm(PublicationType::class,$pub);
        $form->handleRequest($request);
        $user=$this->getUser()->getUsername();

        //$this->get('upload.annotation_reader')->isUploadable($pub);
        if($form->isSubmitted() && $form->isValid())
        {
            $pub->setAuthor($user);
            $em=$this->getDoctrine()->getManager();
            $em->persist($pub);
            $em->flush();

            return $this->redirectToRoute('publication_list');
        }
        return $this->render('@Evaluation\Publication\upload.html.twig',array('form'=>$form->createView()));
    }

    public  function editAction(Request $request,$id)
    {
        $publication=$this->getDoctrine()->getRepository(Publication::class)->find($id);
        $editForm = $this->createForm(PublicationType::class,$publication);
        $editForm->
        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid())
        {
            $publication->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('publication/edit/{id}',array('id'=>$publication->getId()));
        }

        return $this->render('publication/edit',array(
            'publication' => $publication,
            'edit_form'=> $editForm->createView()
        ));
    }

    public function commentPubAction(Request $request,$id)
    {



        $em=$this->getDoctrine()->getManager();
        $coms=$em->getRepository(Commentaire::class)->myGetComment($id);

        $com=new Commentaire();
        $pub=$em->getRepository(Publication::class)->find($id);

        $form=$this->createFormBuilder($com)
            ->add('texte',TextareaType::class)
            ->add('commenter',SubmitType::class)
            ->getForm();
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid())
        {
            $username=$this->getUser()->getUsername();
            $com->setPublication($pub);
            $com->setAuthor($username);
            $em->persist($com);
            $em->flush();

        }
        return $this->render("@Evaluation\Publication\pubComment.html.twig",array('form'=>$form->createView(),'pub'=>$pub,'coms'=>$coms));
    }

    public function addApiAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $pub=new \TgtBundle\Entity\Publication();


        $pub->setAuthor($request->get('auteur'));
        $pub->setVideo($request->get('lien'));
        $pub->setDescription($request->get('desc'));
        $pub->setTitre($request->get('titre'));
        $pub->setCategorie($request->get('cat'));
        $pub->setNbrVote(0);
        $pub->setValide(0);



        $em->persist($pub);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($pub);
        return new JsonResponse($formatted);


    }

    public function allAction()
    {
        $tasks =$this->getDoctrine()->getManager()
            ->getRepository('EvaluationBundle:Publication')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function voteApiAction($id,$idUser)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(Publication::class);
        $pub=$repository->find($id);
        $pub->setNbrVote($pub->getNbrVote()+1);
        $em->persist($pub);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($pub);
        $this->vote2Action($id,$idUser);
        return new JsonResponse($formatted);
    }

    public function vote2Action($id,$idUser)
    {
        $vote= new Vote();
        $em=$this->getDoctrine()->getManager();
        $pub=$em->getRepository(Publication::class)->find($id);


        $pub->setNbrVote($pub->getNbrVote()+1);


        $vote->setPublication($id);
        $vote->setUser($idUser);

        $em->persist($vote);
        $em->flush();

        return true;
    }

}