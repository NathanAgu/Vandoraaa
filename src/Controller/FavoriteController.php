<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Favorite;
use App\Repository\FavoriteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/favorite')]
#[IsGranted('ROLE_USER')]
final class FavoriteController extends AbstractController
{
    #[Route('/toggle/{id}', name: 'app_favorite_toggle', methods: ['POST'])]
    public function toggle(Article $article, FavoriteRepository $favoriteRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        // Chercher si c'est déjà en favori
        $favorite = $favoriteRepository->findOneBy([
            'user' => $user,
            'article' => $article
        ]);

        if ($favorite) {
            // Le retirer des favoris
            $entityManager->remove($favorite);
        } else {
            // L'ajouter aux favoris
            $favorite = new Favorite();
            $favorite->setUser($user);
            $favorite->setArticle($article);
            $entityManager->persist($favorite);
        }

        $entityManager->flush();

        return $this->redirectToRoute('app_article_show', ['id' => $article->getId()]);
    }
}
