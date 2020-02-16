<?php

namespace App\Form;

use App\Entity\Archer;
use App\Entity\ArcherCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArcherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, ['required' => true, 'label' => 'form.lastname'])
            ->add('firstname', TextType::class, ['required' => true, 'label' => 'form.firstname'])
            ->add('birthdate', DateType::class, ['required' => false, 'label' => 'form.birthdate'])
            ->add('gender', ChoiceType::class, array(
                'required' => false,
                'placeholder' => 'Choissisez votre sexe',
                    'choices'  => Archer::getGenderList(),
                    'choice_label' => function ($value, $key, $index) {
                        return $value;
                    },
                ))
            ->add('defaultarc', ChoiceType::class, array(
                'required' => false,
                'placeholder' => 'Choissisez votre arc',
                'choices'  => Archer::getTypeArcList(),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                    },
                ))
            ->add('defaultcategory', EntityType::class,[
                'required' => false,
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
