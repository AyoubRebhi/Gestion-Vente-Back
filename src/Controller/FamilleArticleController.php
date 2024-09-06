<?php

namespace App\Controller;

use App\Entity\FamilleArticle;
use App\Form\FamilleArticleType;
use App\Repository\FamilleArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/famille/article')]
class FamilleArticleController extends AbstractController
{
    #[Route('/', name: 'app_famille_article_index', methods: ['GET'])]
    public function index(FamilleArticleRepository $familleArticleRepository): Response
    {
        return $this->render('famille_article/index.html.twig', [
            'famille_articles' => $familleArticleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_famille_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $familleArticle = new FamilleArticle();
        $form = $this->createForm(FamilleArticleType::class, $familleArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($familleArticle);
            $entityManager->flush();

            return $this->redirectToRoute('app_famille_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('famille_article/new.html.twig', [
            'famille_article' => $familleArticle,
            'form' => $form,
        ]);
    }


}
