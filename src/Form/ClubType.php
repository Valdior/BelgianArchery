<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Archer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('number', NumberType::class)
            ->add('acronym', TextType::class)
            ->add('email', EmailType::class, ['required' => false])
            ->add('website', TextType::class, ['required' => false])
            ->add('region')
            ->add('owner', EntityType::class,[
                'required' => false,
                'label' => 'Responsable',
                'placeholder' => 'Choissisez votre responsable',
                'class' => Archer::class,]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Club::class,
        ]);
    }
}
