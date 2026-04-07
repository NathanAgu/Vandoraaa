<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, ArticleRepository $articleRepository): Response
    {
        $search = $request->query->get('search', '');
        
        if ($search) {
            $articles = $articleRepository->createQueryBuilder('a')
                ->where('a.name LIKE :search OR a.description LIKE :search OR a.brand LIKE :search')
                ->setParameter('search', '%' . $search . '%')
                ->orderBy('a.id', 'DESC')
                ->getQuery()
                ->getResult();
        } else {
            $articles = $articleRepository->findBy([], ['id' => 'DESC']);
        }
        
        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'search' => $search,
        ]);
    }
}
