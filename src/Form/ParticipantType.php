<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Archer;
use App\Entity\Participant;
use App\Entity\ArcherCategory;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $user = $options['user'];
        // $roles = $user->getRoles();
        // if (in_array('ROLE_ADMIN', $roles)) 
        //     $builder->add('archer', EntityType::class, array(
        //         'class' => Archer::class,
        //     ));
        $builder
            ->add('archer', EntityType::class, array(
                'placeholder' => 'Choissisez l\'archer',
                'class' => Archer::class,
                'disabled' => $options['disabled_archer'],
                'data' => $user->getArcher(),
                'attr' => ['data-select' => 'true'],
                'required' => true
            ))
            ->add('category', EntityType::class, [
                'class'  => ArcherCategory::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.minimumAge', 'ASC');
                },
                'group_by' => function($choice, $key, $value) {
                    if (strpos($choice, 'D') !== false) {
                        return 'Dame';
                    } else {
                        return 'Homme';
                    }
                },
            ])
        ;
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event){
                $data = $event->getData();
                $form = $event->getForm();
                if(!empty($data->getId()))
                {
                    $form 
                        ->add('numberOfX')
                        ->add('numberOfTen')
                        ->add('numberOfNine')
                        ->add('points')
                        ->add('isForfeited')
                        ->add('archer', null, array(
                            'disabled' => true,
                        ))
                    ;                    
                }
            }
        );
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {        
        $resolver->setDefaults([
            'data_class' => Participant::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'participant_item',
            'user'  => User::class,
            'disabled_archer'  => true,
            'is_already_registered' => false,
        ]);

        $resolver->setAllowedTypes('disabled_archer', 'bool');
        $resolver->setAllowedTypes('is_already_registered', 'bool');
    }
}
