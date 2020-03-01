<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\AdminRecipient;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoreController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('core/index.html.twig', [
            'controller_name' => 'CoreController',
        ]);
    }

    /**
     * @Route("/test1", name="test")
     */
    public function test(NotifierInterface $notifier)
    {
        $notification = (new Notification('New Invoice', ['chat/slack']))
            ->content('You got a new invoice for 150 EUR.');

        // Send the notification to the recipient
        $notifier->send($notification);

        // $notification = (new Notification('New Invoice', ['email']))
        //     ->content('You got a new invoice for 15 EUR.');
        // $recipient = new AdminRecipient(
        //     'gogeta_vegeto4@hotmail.com',
        //     '0497903017'
        // );
        // $notifier->send($notification, $recipient);

        return $this->redirectToRoute('home');
    }
}
