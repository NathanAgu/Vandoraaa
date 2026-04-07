<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/profile')]
#[IsGranted('ROLE_USER')]
final class ProfileController extends AbstractController
{
    #[Route('', name: 'app_profile', methods: ['GET'])]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/seller/{id}', name: 'app_profile_public', methods: ['GET'])]
    public function publicProfile(int $id, UserRepository $userRepository): Response
    {
        $seller = $userRepository->find($id);

        if (!$seller) {
            throw $this->createNotFoundException('Vendeur non trouvé');
        }

        return $this->render('profile/public.html.twig', [
            'user' => $seller,
            'isPublic' => true,
        ]);
    }
}
