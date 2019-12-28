<?php

namespace App\Form;

use App\Entity\Affiliate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AffiliateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('affiliateNumber', null, ['required' => true])
            ->add('affiliateSince', DateType::class, [ 'widget' => 'single_text', 'required' => true])
            ->add('affiliateEnd', DateType::class, [ 'widget' => 'single_text', 'required' => false])
            ->add('club', null, [
                'disabled' => $options['disabled_club'],
                'required' => true
                ])
            ->add('archer', null, [
                'disabled' => $options['disabled_archer'],
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Affiliate::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'affiliate_item',
            'disabled_archer' => false,
            'disabled_club' => false,
        ]);

        // you can also define the allowed types, allowed values and
        // any other feature supported by the OptionsResolver component
        $resolver->setAllowedTypes('disabled_archer', 'bool');
        $resolver->setAllowedTypes('disabled_club', 'bool');
    }
}
