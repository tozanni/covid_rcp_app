<?php

namespace App\Repository;

use App\Entity\ClottingTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClottingTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClottingTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClottingTime[]    findAll()
 * @method ClottingTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClottingTimeRepository extends ServiceEntityRepository
{
    use AuditTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClottingTime::class);
    }

    // /**
    //  * @return ClottingTime[] Returns an array of ClottingTime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClottingTime
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
