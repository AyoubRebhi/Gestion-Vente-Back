<?php

namespace App\Controller;

use App\Entity\BonRetour;
use App\Repository\VenteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BonRetourController extends AbstractController
{
    #[Route('/api/bon-retour/new', name: 'app_bon_retour_new', methods: ['POST'])]
    public function newBonRetour(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, VenteRepository $venteRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return new JsonResponse(['errors' => 'Invalid JSON'], 400);
        }

        $vente = $venteRepository->findOneBy(['BV' => $data['BV']]);
        if (!$vente) {
            return new JsonResponse(['errors' => 'Sale not found'], 404);
        }

        $bonRetour = new BonRetour();
        $bonRetour->setNumCarteFidalite((string)($data['num_carte_fidalite'] ?? ''));
        $bonRetour->setArticlesRetours((array)($data['articlesRetours'] ?? []));
        $bonRetour->setTotalRetour((float)($data['totalRetour'] ?? 0.0));
        //$bonRetour->setRemboursement((float)($data['remboursement'] ?? 0.0));
        $bonRetour->setDateRetour(new \DateTime());
        $bonRetour->setBV($data['BV']);
        $bonRetour->setVente($vente);

        $errors = $validator->validate($bonRetour);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], 400);
        }

        $entityManager->persist($bonRetour);
        $entityManager->flush();

        return new JsonResponse(['message' => 'BonRetour created successfully'], 201);
    }
}
