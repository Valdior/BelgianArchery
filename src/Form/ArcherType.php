<?php

namespace App\Form;

use App\Entity\Archer;
use App\Type\BirthdayType;
use App\Entity\ArcherCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArcherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, ['required' => true, 'label' => 'form.archer.lastname'])
            ->add('firstname', TextType::class, ['required' => true, 'label' => 'form.archer.firstname'])
            ->add('birthdate', BirthdayType::class, ['required' => false, 'label' => 'form.archer.birthdate', 'widget' => 'single_text'])
            ->add('gender', ChoiceType::class, array(
                'required' => false,
                'label' => 'form.archer.gender',
                'placeholder' => 'form.archer.gender',
                'choices'  => Archer::getGenderList(),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                },
                ))
            ->add('defaultarc', ChoiceType::class, array(
                'required' => false,
                'label' => 'form.archer.defaultArc',
                'placeholder' => 'Choissisez votre arc',
                'choices'  => Archer::getTypeArcList(),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                    },
                ))
            ->add('defaultcategory', EntityType::class,[
                'required' => false,
                'label' => 'form.archer.defaultCategory',
                'placeholder' => 'Choissisez votre categorie',
                'class' => ArcherCategory::class,]
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Archer::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ]);
    }
}
