<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @return Article[]
     */
    public function findBySearchParam(string $searchParam): array
    {
        $queryBuilder = $this->createQueryBuilder('a');
        
        if (ctype_digit($searchParam)) {
            $queryBuilder
                ->orWhere('a.code_barre = :searchParam')
                ->setParameter('searchParam', $searchParam);
        } else {
            $queryBuilder
                ->orWhere('a.nom LIKE :searchParam')
                ->orWhere('a.reference LIKE :searchParam')
                ->setParameter('searchParam', '%' . $searchParam . '%');
        }

        /** @var Article[] $results */
        $results = $queryBuilder->getQuery()->getResult();

        return $results;
    }
}
