<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\RemisePromotionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class ArticleController extends AbstractController
{
    #[Route('/article/', name: 'app_article_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }
    #[Route('/article/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }


    #[Route('/api/article/search', name: 'app_article_search', methods: ['GET'])]
    public function search(Request $request, ArticleRepository $articleRepository): Response
    {
        $searchParam = $request->query->get('searchParam', '');

        if (ctype_digit($searchParam)) {
            // Si searchParam est entièrement composé de chiffres, le traiter comme une chaîne.
            $articles = $articleRepository->findBy(['code_barre' => $searchParam]);
        } else {
            // Sinon, effectuer la recherche en utilisant les champs texte.
            $articles = $articleRepository->findBySearchParam((string) $searchParam);
        }

        return $this->json($articles, 200, [], ['groups' => 'article:read']);
    }

    #[Route('/api/remise/{id<\d+>}', name: 'app_article_remise', methods: ['GET'])]
    public function showRemise(RemisePromotionRepository $remisePromotionRepository, int $id): JsonResponse
    {
        $remisePromotion = $remisePromotionRepository->find($id);

        if (!$remisePromotion) {
            throw $this->createNotFoundException('La remise n\'existe pas');
        }

        $remiseType = $remisePromotion->getRemiseArticle();
        $typeValRemise = $remisePromotion->valRemise();
        $valeur_remise = $remisePromotion->getValeurRemise();

        return new JsonResponse([
            'type_remise' => $remiseType,
            'typeVal_remise' => $typeValRemise,
            'valeur_remise' => $valeur_remise
        ]);
    }
    #[Route('/api/article/{id}', name: 'app_article_show', methods: ['GET'])]
    public function show(int $id, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($id);

        if (!$article) {
            return new JsonResponse(['error' => 'Article not found'], 404);
        }

        return $this->json($article, 200, [], ['groups' => 'article:read']);
    }

}
