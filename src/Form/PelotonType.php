<?php

namespace App\Form;

use App\Type\DateTimeType;
use App\Entity\Peloton;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PelotonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxParticipant', IntegerType::class)
            ->add('type', ChoiceType::class, array(
                'required' => true,
                'label' => 'Type de tir',
                'placeholder' => 'Choissisez le type de tir',
                'choices'  => Peloton::getTypeList(),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                }))
            ->add('startTime', DateTimeType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Peloton::class,
        ]);
    }
}
