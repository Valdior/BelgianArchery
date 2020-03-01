<?php 

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Notifier\Recipient\AdminRecipient;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    /**
     * @var \NotifierInterface
     */
    private $notifier;

    public function __construct(\Swift_Mailer $mailer, TranslatorInterface $translator, NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
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
        $this->preventAdmin($user);
    }

    public function preventAdmin(User $user)
    {
        $notification = (new Notification('Nouvelle utilisateur', ['chat/slack']))
            ->content('Un nouvelle utilisateur "'. $user->getUsername().'" vient de s\'enregistrer.');

        // Send the notification to the recipient
        $this->notifier->send($notification);
    }
}