<?php

namespace App\Repository;

use App\Entity\Vente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vente>
 */
class VenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vente::class);
    }

    /**
     * @return array<int, array{vente: Vente, clientName: string}>
     */
    public function findVentesByCaisseSortedByDate(int $idCaisse): array
    {
        $results = $this->createQueryBuilder('v')
            ->leftJoin('App\Entity\ClientPV', 'c', 'WITH', 'c.num_carte_fidalite = v.num_carte_fidalite')
            ->where('v.id_caisse = :idCaisse')
            ->setParameter('idCaisse', $idCaisse)
            ->orderBy('v.dateAchat', 'DESC')
            ->select('v', 'c.nom_prenom')
            ->getQuery()
            ->getArrayResult();

        $finalResults = [];

        foreach ($results as $result) {
            if (is_array($result) && isset($result['v']) && isset($result['nom_prenom'])) {
                $vente = $result['v'];
                $clientName = $result['nom_prenom'];
                $finalResults[] = [
                    'vente' => $vente,
                    'clientName' => (string) $clientName,
                ];
            }
        }

        return $finalResults;
    }

    /**
     * @return array<int, array{vente: Vente, clientName: string}>
     */
    public function searchVenteBy(string $searchTerm): array
    {
        $results = $this->createQueryBuilder('v')
            ->leftJoin('App\Entity\ClientPV', 'c', 'WITH', 'c.num_carte_fidalite = v.num_carte_fidalite')
            ->where('v.BV LIKE :searchTerm OR c.nom_prenom LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->select('v', 'c.nom_prenom')
            ->getQuery()
            ->getResult();

        $finalResults = [];

        if (is_iterable($results)) {
            foreach ($results as $result) {
                /** @var Vente $vente */
                $vente = $result['v'] ?? null;
                $clientName = $result['nom_prenom'] ?? '';
                if ($vente instanceof Vente) {
                    $finalResults[] = [
                        'vente' => $vente,
                        'clientName' => (string) $clientName,
                    ];
                }
            }
        }

        return $finalResults;
    }

    /**
     * @return array<int, array{vente: Vente, clientName: string}>
     */
    public function searchVenteByBV(string $BV): array
    {
        $results = $this->createQueryBuilder('v')
            ->leftJoin('App\Entity\BonRetour', 'br', 'WITH', 'v.BV = br.BV')
            ->leftJoin('App\Entity\ClientPV', 'c', 'WITH', 'c.num_carte_fidalite = v.num_carte_fidalite')
            ->where('v.BV = :BV')
            ->setParameter('BV', $BV)
            ->select('v', 'c.nom_prenom')
            ->getQuery()
            ->getResult();

        $finalResults = [];

        if (is_iterable($results)) {
            foreach ($results as $result) {
                /** @var Vente $vente */
                $vente = $result['v'] ?? null;
                if ($vente instanceof Vente) {
                    $returnedArticles = [];
                    foreach ($vente->getBonsRetour() as $bonRetour) {
                        $returnedArticles = array_merge($returnedArticles, $bonRetour->getArticlesRetours());
                    }

                    $filteredArticles = array_filter($vente->getListeArticles(), function ($article) use ($returnedArticles) {
                        foreach ($returnedArticles as $returnedArticle) {
                            if ($article['article'] === $returnedArticle['article']) {
                                return false;
                            }
                        }
                        return true;
                    });

                    if (!empty($filteredArticles)) {
                        $vente->setListeArticles($filteredArticles);
                        $finalResults[] = [
                            'vente' => $vente,
                            'clientName' => (string)($result['nom_prenom'] ?? ''),
                        ];
                    }
                }
            }
        }

        return $finalResults;
    }
}

