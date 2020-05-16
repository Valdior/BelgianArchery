<?php

namespace App\Form;

use App\Entity\Attachment;
use App\Form\TournamentType;
use Symfony\Component\Form\FormView;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AttachmentType extends TextType implements DataTransformerInterface
{
    // private $em;
    // private $attachmentUrlGenerator;

    // public function __construct(
    //     EntityManagerInterface $em,
    //     AttachmentUrlGenerator $attachmentUrlGenerator
    // )
    // {
    //     $this->em = $em;
    //     $this->attachmentUrlGenerator = $attachmentUrlGenerator;
    // }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addViewTransformer($this);
        parent::buildForm($builder, $options);

        $builder->add('attachmentName');
    }

    // public function buildView(FormView $view, FormInterface $form, array $options): void
    // {
    //     $view->vars['attr']['preview'] = $this->attachmentUrlGenerator->generate($form->getData());
    //     $view->vars['attr']['overwrite'] = true;
    //     parent::buildView($view, $form, $options);
    // }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'required' => false,
            'attr' => [
                'is' => 'input-attachment',
            ],
            
            // 'constraints' => [
            //     new AttachmentExist()
            // ]
        ]);
        parent::configureOptions($resolver);
    }

    public function getParent()
    {
        return TextType::class;
    }

    // /**
    //  * @param ?Attachment $attachment
    //  */
    // public function transform($attachment): ?int
    // {
    //     if ($attachment instanceof Attachment) {
    //         return $attachment->getId();
    //     }
    //     return null;
    // }

    // /**
    //  * @param int $value
    //  */
    // public function reverseTransform($value): ?Attachment
    // {
    //     if (empty($value)) {
    //         return null;
    //     }
    //     return $this->em->getRepository(Attachment::class)->find($value) ?: new NonExistingAttachment($value);
    // }
    // public function buildForm(FormBuilderInterface $builder, array $options)
    // {
    //     $builder
    //         ->add('attachmentFile', FileType::class, [
    //             'required' => false,
    //         ])
    //     ;
    // }

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     // $resolver->setDefaults([
    //     //     'data_class' => Attachment::class,
    //     // ]);
    // }
}
