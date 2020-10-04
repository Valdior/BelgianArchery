<?php

namespace App\Form;

use App\Type\DateTimeType;
use App\Entity\Peloton;
use App\Entity\Tournament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PelotonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tournament = $options['tournament'];

        $builder
            ->add('maxParticipant', IntegerType::class, [
                'label' => 'peloton.max_participant'
            ])
            ->add('type', ChoiceType::class, array(
                'required' => true,
                'label' => 'peloton.type',
                'placeholder' => 'peloton.type_placeholder',
                'choices'  => Peloton::getTypeList(),
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                }))
            ->add('startTime', DateTimeType::class, [
                'required' => true, 
                'label' => 'peloton.start_time', 
                'widget' => 'single_text'
                // 'min'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Peloton::class,
            'csrf_token_id' => 'peloton',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'translation_domain' => 'forms',
            'tournament'  => Tournament::class,
        ]);
    }
}
