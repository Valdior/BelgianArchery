<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/sendmail", name="sendmail")
     */
    public function sendmail(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('marechal.pierre@live.be')
            ->setBody(
                $this->renderView(
                    // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    ['name' => 'Test mailing']
                ),
                'text/html'
            )

            // you can remove the following code if you don't define a text version for your emails
            ->addPart(
                $this->renderView(
                    // templates/emails/registration.txt.twig
                    'emails/registration.txt.twig',
                    ['name' => 'Test mailing']
                ),
                'text/plain'
            )
        ;

        $mailer->send($message);

        return $this->render('core/index.html.twig', [
            'controller_name' => 'CoreController',
        ]);
    }
}
