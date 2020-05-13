<?php

namespace App\Repository;

use App\Entity\Triage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Triage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Triage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Triage[]    findAll()
 * @method Triage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TriageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Triage::class);
    }

    // /**
    //  * @return Triage[] Returns an array of Triage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Triage
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
