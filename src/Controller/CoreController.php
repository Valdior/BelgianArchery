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
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('core/index.html.twig', [
            'controller_name' => 'CoreController',
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(NotifierInterface $notifier)
    {
        $notification = (new Notification('New Invoice', ['chat/slack']))
            ->content('You got a new invoice for 150 EUR.');

        // Send the notification to the recipient
        // $notifier->send($notification);

        return $this->redirectToRoute('home');
    }
}
