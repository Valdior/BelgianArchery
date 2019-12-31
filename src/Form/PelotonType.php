<?php

namespace App\Form;

use App\Entity\Peloton;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PelotonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxParticipant')
            ->add('type')
            ->add('startTime')
            ->add('tournament')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Peloton::class,
        ]);
    }
}
