<?php

namespace TgtBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
            ->add('description')
            ->add('Categorie',ChoiceType::class,array(
                'choices'=>array(
                    'Magie'=>'Magie',
                    'Chant'=>'Chant',
                    'Illusion'=>'Illusion',
                    'Autre'=>'Autre'
                )))
            ->add('evenement',EntityType::class,array(
                'class'=>'TgtBundle:Evenement',
                'choice_label'=>'nom',
                'multiple'=>false
            ))
            ->add('video', FileType::class,  array('label'=>'Votre Video :','required' => false
            ))
            ->add('ajouter',SubmitType::class);
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TgtBundle\Entity\Publication'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tgtbundle_publication';
    }


}
