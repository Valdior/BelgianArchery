<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Security\LoginFormAuthenticator;
use App\Security\ConfirmationRegistration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, ConfirmationRegistration $confirm, TranslatorInterface $translator)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setTokenPassword($this->generateToken());

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', $translator->trans('registration.check_email', ['%email%' => $user->getEmail()]));
            $confirm->sendConfirmation($user);

            return $this->redirectToRoute('home');
        }

        return $this->render(
            'registration/index.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/register/{token}/{username}", name="user_registration_confirm")
     * @param $token
     * @param $user
     * @return Route
     */
    public function confirmUser(Request $request, string $token, User $user, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $formAuthenticator, TranslatorInterface $translator): RedirectResponse
    {        
        $tokenExist = $user->getTokenPassword();
        if($token === $tokenExist) {
            $user->setTokenPassword(null);
            $user->setEnabled(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', $translator->trans('registration.confirmed', ['%username%' => $user->getUsername()])); //'Votre inscription a été confirmé, bienvenue parmis nous ' . $user->getUsername() . ' ! :)');

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $formAuthenticator,
                'main'
            );
        } else {
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function generateToken()
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }
}