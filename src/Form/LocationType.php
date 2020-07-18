<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'required' => true, 
                'label' => 'location.title', 
                ])
            ->add('street', null, [
                'required' => true, 
                'label' => 'location.street', 
                ])
            ->add('number', null, [
                'required' => true, 
                'label' => 'location.number', 
                ])
            ->add('locality', null, [
                'required' => true, 
                'label' => 'location.locality', 
                ])
            ->add('postalcode', null, [
                'required' => true, 
                'label' => 'location.postalcode', 
                ])
            ->add('city', null, [
                'required' => true, 
                'label' => 'location.city', 
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
            'translation_domain' => 'forms'
        ]);
    }
}
