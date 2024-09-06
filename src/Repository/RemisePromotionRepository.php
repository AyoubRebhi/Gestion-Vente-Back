<?php
namespace App\Repository;

use App\Entity\RemisePromotion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RemisePromotion>
 *
 * @method RemisePromotion|null find($id, $lockMode = null, $lockVersion = null)
 * @method RemisePromotion|null findOneBy(array $criteria, array $orderBy = null)
 * @method RemisePromotion[]    findAll()
 * @method RemisePromotion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemisePromotionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RemisePromotion::class);
    }

    /**
     * Finds the active remise promotions.
     *
     * @return RemisePromotion[]
     */
    public function findActiveRemises(): array
    {
        /** @var RemisePromotion[] $results */
        $results = $this->createQueryBuilder('r')
            ->where('r.date_debut <= :now')
            ->andWhere('r.date_fin >= :now')
            ->setParameter('now', new \DateTime())
            ->getQuery()
            ->getResult();

        return $results;
    }
}

