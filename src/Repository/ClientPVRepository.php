<?php

namespace App\Repository;

use App\Entity\ClientPV;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClientPV>
 */
class ClientPVRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientPV::class);
    }

    /**
     * @return ClientPV[]
     */
    public function findBySearchParam(?string $searchParam): array
    {
        $qb = $this->createQueryBuilder('a');

        if ($searchParam) {
            $qb->andWhere('a.cin LIKE :searchParam OR a.num_carte_fidalite LIKE :searchParam OR a.num_tel LIKE :searchParam')
               ->setParameter('searchParam', '%'.$searchParam.'%');
        }

        /** @var ClientPV[] */
        return $qb->getQuery()->getResult();
    }
}
