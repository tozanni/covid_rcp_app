<?php

namespace App\Repository;

use App\Entity\LiverFunction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LiverFunction|null find($id, $lockMode = null, $lockVersion = null)
 * @method LiverFunction|null findOneBy(array $criteria, array $orderBy = null)
 * @method LiverFunction[]    findAll()
 * @method LiverFunction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LiverFunctionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LiverFunction::class);
    }

    // /**
    //  * @return LiverFunction[] Returns an array of LiverFunction objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LiverFunction
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
