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
                'label' => 'tournament.type', 
                'placeholder' => 'tournament.type.placeholder',
                'choices'  => Tournament::getTypeList(),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                },
            ))
            ->add('title', null, [
                'required' => true, 
                'label' => 'tournament.title', 
                ])
            ->add('organizer', null, [
                'required' => true, 
                'label' => 'tournament.organizer', 
                ])
            ->add('contact', null, [
                'required' => true, 
                'label' => 'tournament.contact', 
                ])
            ->add('information', null, [
                'required' => true, 
                'label' => 'tournament.information', 
                ])
            ->add('location', LocationType::class, [
                'required' => true, 
                'label' => 'tournament.location', 
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tournament::class,
            'csrf_token_id' => 'tournament',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'translation_domain' => 'forms'
        ]);
    }
}
