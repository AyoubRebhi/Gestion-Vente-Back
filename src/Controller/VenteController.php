<?php

namespace App\Controller;
use App\Entity\Vente;
use App\Entity\ClientPV;
use App\Entity\Article;
use App\Repository\ClientPVRepository;
use App\Repository\PointDeVenteRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\VenteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Psr\Log\LoggerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class VenteController extends AbstractController
{
    private ManagerRegistry $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    // src/Controller/VenteController.php

    #[Route('/api/vente/historique/{idCaisse}', name: 'app_vente_historique', methods: ['GET'])]
    public function getVentesByCaisse(int $idCaisse, VenteRepository $venteRepository): JsonResponse
    {
        $ventes = $venteRepository->findVentesByCaisseSortedByDate($idCaisse);

        $result = [];
        foreach ($ventes as $vente) {
            $result[] = [
                'vente' => $vente[0],
                'clientName' => $vente['nom_prenom']
            ];
        }

        return $this->json($result, 200, [], ['groups' => 'vente:read']);
    }

    #[Route('/api/vente/new', name: 'app_vente_new', methods: ['POST'])]
    public function newVente(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, LoggerInterface $logger, VenteRepository $venteRepository, ClientPVRepository $clientRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return new JsonResponse(['errors' => 'Invalid JSON'], 400);
        }

        $logger->info('Received data:', $data);

        foreach ($data['listeArticles'] as $article) {
            if (!isset($article['article'])) {
                return new JsonResponse(['errors' => 'Invalid article data structure: ' . json_encode($article)], 400);
            }
        }

        $client = $clientRepository->findOneBy(['num_carte_fidalite' => $data['num_carte_fidalite'] ?? '']);
        if (!$client) {
            return new JsonResponse(['errors' => ['Client not found']], 404);
        }

        $vente = new Vente();
        $vente->setNumCarteFidalite((string)($data['num_carte_fidalite'] ?? ''));
        $vente->setListeArticles((array)($data['listeArticles'] ?? []));
        $vente->setRemiseGlobale((float)($data['remiseGlobale'] ?? 0.0));
        $vente->setNetApayer((float)($data['netApayer'] ?? 0.0));
        $vente->setPayer((float)($data['payer'] ?? 0.0));
        $vente->setARendre((float)($data['aRendre'] ?? 0.0));
        $vente->setTotalTTC((float)($data['totalTTC'] ?? 0.0));
        $vente->setIdCaisse((int)($data['idCaisse'] ?? 0));
        $vente->setDateAchat(new \DateTime());
        $vente->setBV($this->generateUniqueBV($venteRepository));

        $errors = $validator->validate($vente);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            $logger->error('Validation errors: ', $errorMessages);
            return new JsonResponse(['errors' => $errorMessages], 400);
        }

        // Update the client's points with the new value sent from the frontend
        $client->setPointsCarteFidalite((int)$data['newPointsCarteFidalite']);

        try {
            $entityManager->persist($vente);
            $entityManager->flush();
            
            $logger->info('Vente saved to database with BV: ' . $vente->getBV());

            $entityManager->flush();

        } catch (\Exception $e) {
            $logger->error('Error saving sale: ' . $e->getMessage());
            return new JsonResponse(['errors' => ['Internal Server Error']], 500);
        }

        $logger->info('Sale created successfully with BV: ' . $vente->getBV());
        return new JsonResponse(['message' => 'Vente created successfully', 'BV' => $vente->getBV()], 201);
    }

    #[Route('/api/vente/export-pdf/{bv}', name: 'app_vente_export_pdf', methods: ['GET'])]
    public function exportPdf(string $bv, VenteRepository $venteRepository, ClientPVRepository $clientRepository, PointDeVenteRepository $pointDeVenteRepository, LoggerInterface $logger): Response
    {
        try {
            $vente = $venteRepository->findOneBy(['BV' => $bv]);

            if (!$vente) {
                throw new \Exception('La vente n\'existe pas');
            }

            $client = $clientRepository->findOneBy(['num_carte_fidalite' => $vente->getNumCarteFidalite()]);
            if (!$client) {
                return new JsonResponse(['errors' => ['Client not found']], 404);
            }

            $nomPrenom = $client->getNomPrenom();
            $numCarteFidalite = $client->getNumCarteFidalite();
            $pointFidelite = $client->getPointsCarteFidalite();
            $logoUrl = 'C:\Users\Admin\Desktop\Stage\gestion_point_vente_back\public\img\etclogo.jpg';

            // Log the article data structure
            $logger->info('Article data received: ' . json_encode($vente->getListeArticles()));

            // Retrieve the articles and add the 'nom' key
            $articles = [];
            foreach ($vente->getListeArticles() as $articleData) {
                $articleEntity = $this->managerRegistry->getRepository(Article::class)->find($articleData['article']);
                if (!$articleEntity) {
                    throw $this->createNotFoundException('Article not found');
                }

                $articleEntity = $this->managerRegistry->getRepository(Article::class)->find($articleData['article']);
                if (!$articleEntity) {
                    throw $this->createNotFoundException('Article not found');
                }

                $articles[] = array_merge($articleData, [
                    'nom' => $articleEntity->getNom(),
                    'reference' => $articleEntity->getReference(),
                    'prixTTC' => $articleEntity->getPrixVenteTtc(),
                ]);
            }

            $template = $vente->getAcompte() !== 0.0 ? 'acompte/print.html.twig' : 'vente/print.html.twig';
            $dateAchat = $vente->getDateAchat();
            $formattedDate = $dateAchat !== null ? $dateAchat->format('Y-m-d H:i:s') : '';
            $html = $this->renderView($template, [
                'vente' => $vente,
                'clientNomPrenom' => $nomPrenom,
                'client' => $client,
                'articles' => $articles,
                'date' => $formattedDate,
                'logo_url' => $logoUrl,
                'numCarteFidalite' => $numCarteFidalite,
                'pointFidelite' => $pointFidelite,
            ]);

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->render();

            return new Response($dompdf->output(), Response::HTTP_OK, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="vente_' . $vente->getBV() . '.pdf"',
            ]);
        } catch (\Exception $e) {
            $logger->error('Error generating PDF: ' . $e->getMessage());
            return new JsonResponse(['error' => 'Error generating PDF', 'message' => $e->getMessage()], 500);
        }
    }


    #[Route('/api/vente/export-pdf/all/{id_caisse}', name: 'app_vente_export_all_pdf', methods: ['GET'])]
    public function exportAllPdf(int $id_caisse, VenteRepository $venteRepository, ClientPVRepository $clientRepository, LoggerInterface $logger): Response
    {
        try {
            $today = new \DateTime();
            $today->setTime(0, 0, 0);

            // Explicitly specify the return type as an array of Vente objects
            /** @var Vente[] $ventes */
            $ventes = $venteRepository->createQueryBuilder('v')
                ->where('v.dateAchat >= :today')
                ->andWhere('v.id_caisse = :id_caisse')
                ->setParameter('today', $today)
                ->setParameter('id_caisse', $id_caisse)
                ->getQuery()
                ->getResult();

            if (!$ventes) {
                throw new \Exception('Aucune vente trouvée pour aujourd\'hui dans cette caisse');
            }

            $allVentesData = [];
            $profitDeJour = 0;
            $date = (new \DateTime())->format('Y-m-d');

            foreach ($ventes as $vente) {
                $client = $clientRepository->findOneBy(['num_carte_fidalite' => $vente->getNumCarteFidalite()]);
                if (!$client) {
                    throw new \Exception('Client non trouvé pour la vente ' . $vente->getBV());
                }

                $articles = [];
                foreach ($vente->getListeArticles() as $articleData) {
                    // Remove the unnecessary isset() check
                    $articleEntity = $this->managerRegistry->getRepository(Article::class)->find($articleData['article']);
                    if (!$articleEntity) {
                        throw new \Exception('Article non trouvé');
                    }

                    $articles[] = array_merge($articleData, [
                        'nom' => $articleEntity->getNom(),
                        'reference' => $articleEntity->getReference(),
                        'prixTTC' => $articleEntity->getPrixVenteTtc(),
                    ]);
                }

                $allVentesData[] = [
                    'vente' => $vente,
                    'client' => $client,
                    'articles' => $articles,
                    'numCarteFidalite' => $client->getNumCarteFidalite(),
                    'pointFidelite' => $client->getPointsCarteFidalite(),
                    'dateAchat' => $vente->getDateAchat() !== null ? $vente->getDateAchat()->format('Y-m-d H:i:s') : '',
                ];

                $profitDeJour += $vente->getTotalTTC() ?? 0.0;
            }

            $logoUrl = 'C:\Users\Admin\Desktop\Stage\gestion_point_vente_back\public\img\etclogo.jpg';

            $html = $this->renderView('vente/print_all.html.twig', [
                'allVentesData' => $allVentesData,
                'logo_url' => $logoUrl,
                'date' => $date,
                'id_caisse' => $id_caisse,
                'profitDeJour' => $profitDeJour,
            ]);

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->render();

            return new Response($dompdf->output(), Response::HTTP_OK, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="ventes_du_jour.pdf"',
            ]);
        } catch (\Exception $e) {
            $logger->error('Error generating PDF: ' . $e->getMessage());
            return new JsonResponse(['error' => 'Error generating PDF', 'message' => $e->getMessage()], 500);
        }
    }

    #[Route('/api/vente/generate-bv', name: 'app_generate_bv', methods: ['GET'])]
    public function generateBV(VenteRepository $venteRepository): JsonResponse
    {
        $BV = $this->generateUniqueBV($venteRepository);
        return new JsonResponse(['BV' => $BV], 200);
    }

    private function generateUniqueBV(VenteRepository $venteRepository): string
    {
        $unique = false;
        $BV = '';

        while (!$unique) {
            $BV = $this->generateRandomString(10);
            $existingVente = $venteRepository->findOneBy(['BV' => $BV]);
            if (!$existingVente) {
                $unique = true;
            }
        }

        return $BV;
    }

    private function generateRandomString(int $length = 10): string
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    #[Route('/api/vente/search', name: 'app_vente_search', methods: ['GET'])]
    public function searchVenteBy(Request $request, VenteRepository $venteRepository): JsonResponse
    {
        $searchTerm = (string) $request->query->get('searchTerm', '');

        if (!$searchTerm) {
            return new JsonResponse(['errors' => 'Search term is required'], 400);
        }

        $ventes = $venteRepository->searchVenteBy($searchTerm);

        $result = [];
        foreach ($ventes as $vente) {
            $result[] = [
                'vente' => $vente[0],
                'clientName' => $vente['nom_prenom']
            ];
        }

        return $this->json($result, 200, [], ['groups' => 'vente:read']);
    }
    
    #[Route('/api/vente/searchByBV', name: 'app_vente_search_by_bv', methods: ['GET'])]
    public function searchVenteByBV(Request $request, VenteRepository $venteRepository): JsonResponse
    {
        $BV = (string) $request->query->get('BV', '');

        if (!$BV) {
            return new JsonResponse(['errors' => 'BV is required'], 400);
        }

        $ventes = $venteRepository->searchVenteByBV($BV);

        return $this->json($ventes, 200, [], ['groups' => 'vente:read']);
    }
}
