<?php

namespace App\Controller;

use App\Entity\ClientPV;
use App\Repository\ClientPVRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ClientController extends AbstractController
{
    #[Route('/api/csrf-token', name: 'api_csrf_token', methods: ['GET'])]
    public function getCsrfToken(CsrfTokenManagerInterface $csrfTokenManager): JsonResponse
    {
        $csrfToken = $csrfTokenManager->getToken('client_form')->getValue();
        return new JsonResponse(['csrfToken' => $csrfToken]);
    }

    #[Route('/client', name: 'app_client_index', methods: ['GET'])]
    public function index(ClientPVRepository $clientRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    #[Route('/api/client/new', name: 'app_client_new', methods: ['POST'])]
    public function newClient(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return new JsonResponse(['errors' => 'Invalid JSON'], 400);
        }

        $client = new ClientPV();
        $client->setNomPrenom($data['nom_prenom'] ?? '');
        $client->setCin($data['cin'] ?? '');
        $client->setNumTel($data['num_tel'] ?? '');
        $client->setDateNaissance(new \DateTimeImmutable($data['date_naissance'] ?? 'now'));
        $client->setEmail($data['email'] ?? null);
        $client->setNumCarteFidalite($data['num_carte_fidalite'] ?? null);

        // Vérifiez si un client avec le même CIN existe déjà
        $existingClientPV = $entityManager->getRepository(ClientPV::class)->findOneBy(['cin' => $client->getCin()]);
        if ($existingClientPV) {
            return new JsonResponse(['errors' => 'Un client avec ce CIN existe déjà.'], 400);
        }

        $errors = $validator->validate($client);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], 400);
        }

        $entityManager->persist($client);
        $entityManager->flush();

        return new JsonResponse(['message' => 'ClientPV created successfully'], 201);
    }

    #[Route('/api/client/generate-fidelity-card', name: 'app_client_generate_fidelity_card', methods: ['GET'])]
    public function generateUniqueCarteFidalite(ClientPVRepository $clientRepository): JsonResponse
    {
        $numCarteFidalite = $this->generateUniqueCarteFidalite1($clientRepository);
        return new JsonResponse(['num_carte_fidalite' => $numCarteFidalite], 200);
    }

    private function generateUniqueCarteFidalite1(ClientPVRepository $clientRepository): string
    {
        $unique = false;
        $numCarteFidalite = '';

        while (!$unique) {
            $numCarteFidalite = $this->generateRandomString(12);
            $existingClientPV = $clientRepository->findOneBy(['num_carte_fidalite' => $numCarteFidalite]);
            if (!$existingClientPV) {
                $unique = true;
            }
        }

        return $numCarteFidalite;
    }

    private function generateRandomString(int $length = 12): string
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    #[Route('/api/client/search', name: 'app_client_search', methods: ['GET'])]
    public function search(Request $request, ClientPVRepository $clientRepository): Response
    {
        $searchParam = $request->query->get('searchParam', '');

        $clients = $clientRepository->findBySearchParam((string)$searchParam);

        return $this->json($clients, 200, [], ['groups' => 'client:read']);
    }
    #[Route('/api/client/{num_carte_fidalite}', name: 'app_client_get_by_num_carte_fidalite', methods: ['GET'])]
    public function getClientByNumCarteFidalite(string $num_carte_fidalite, ClientPVRepository $clientRepository): JsonResponse
    {
        $client = $clientRepository->findOneBy(['num_carte_fidalite' => $num_carte_fidalite]);

        if (!$client) {
            return new JsonResponse(['error' => 'Client not found'], 404);
        }

        return $this->json($client, 200, [], ['groups' => 'client:read']);
    }
}
