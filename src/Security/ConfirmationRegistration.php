<?php 

namespace App\Security;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;

class ConfirmationRegistration extends AbstractController
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \TranslatorInterface
     */
    private $translator;

    public function __construct(\Swift_Mailer $mailer, TranslatorInterface $translator)
    {
        // $this->user = $user;
        $this->mailer = $mailer;
        $this->translator = $translator;
    }

    public function sendConfirmation(User $user)
    {
        $message = (new \Swift_Message($this->translator->trans('registration.email.subject', ['%username%' => $user->getUsername()])))
            ->setFrom('admin@example.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    'emails/registration.html.twig',
                    ['user' => $user]
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

}