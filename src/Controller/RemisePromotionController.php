<?php

namespace App\Controller;

use App\Entity\RemisePromotion;
use App\Form\RemisePromotionType;
use App\Repository\RemisePromotionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class RemisePromotionController extends AbstractController
{
    #[Route('/remise', name: 'app_remise_promotion_index', methods: ['GET'])]
    public function index(RemisePromotionRepository $remisePromotionRepository): Response
    {
        return $this->render('remise_promotion/index.html.twig', [
            'remise_promotions' => $remisePromotionRepository->findAll(),
        ]);
    }

    #[Route('/api/remise/search', name: 'app_remise_promotion_search', methods: ['GET'])]
    public function searchRemise(RemisePromotionRepository $remisePromotionRepository): JsonResponse
    {
        $remises = $remisePromotionRepository->findActiveRemises();

        $remiseIds = array_map(function ($remise) {
            return $remise->getId();
        }, $remises);

        return new JsonResponse(['ids' => $remiseIds]);
    }
}
