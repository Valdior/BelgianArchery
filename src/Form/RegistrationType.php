<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'form.user.username',
                'attr' => [
                    'placeholder' => 'form.user.username',
                    'title' => 'form.user.username',
                    ],
                ])
            ->add('email', EmailType::class, [
                'label' => 'form.user.email',
                'attr' => [
                    'placeholder' => 'form.user.email',
                    'title' => 'form.user.email',
                    ],
                ])            
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                    ],
                ],
                'first_options' => [
                    'label' => 'form.user.password',
                    'attr' => [
                        'placeholder' => 'form.user.password',
                        'title' => 'form.user.password',
                        ],
                ],
                'second_options' => [
                    'label' => 'form.user.password_confirmation',
                    'attr' => [
                        'placeholder' => 'form.user.password_confirmation',
                        'title' => 'form.user.password_confirmation',
                        ],
                ],
                'invalid_message' => 'form.user.mismatch',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_token_id' => 'registration',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ]);
    }

    // BC for SF < 3.0
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'user_registration';
    }
}
