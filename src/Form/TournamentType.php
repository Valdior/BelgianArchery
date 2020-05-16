<?php

namespace App\Form;

use App\Entity\Tournament;
use App\Form\LocationType;
use App\Type\DateType;
use App\Form\AttachmentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TournamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class, [
                'required' => true, 
                'label' => 'tournament.startdate', 
                'widget' => 'single_text'
                ])
            ->add('endDate', DateType::class, [
                'required' => true, 
                'label' => 'tournament.enddate', 
                'widget' => 'single_text'
                ])
            ->add('type', ChoiceType::class, array(
                'required' => true,
                'label' => 'Indoor/Outdoor',
                'placeholder' => 'Choissisez le type de compétition',
                'choices'  => Tournament::getTypeList(),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                },
            ))
            ->add('title')
            ->add('organizer')
            ->add('contact')
            ->add('information')
            ->add('location', LocationType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tournament::class,
            'csrf_token_id' => 'tournament',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ]);
    }
}
