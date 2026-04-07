<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['GET'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if user is already logged in, redirect to home
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/login_check', name: 'app_login_check', methods: ['POST'])]
    public function loginCheck(): Response
    {
        // This will be handled by Symfony's security login handler
        throw new \LogicException('This method can be blank - it will be intercepted by the login firewall.');
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): Response
    {
        // This will be handled by Symfony's security logout handler
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
