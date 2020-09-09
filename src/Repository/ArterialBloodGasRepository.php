<?php

namespace App\Repository;

use App\Entity\ArterialBloodGas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArterialBloodGas|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArterialBloodGas|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArterialBloodGas[]    findAll()
 * @method ArterialBloodGas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArterialBloodGasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArterialBloodGas::class);
    }

    // /**
    //  * @return ArterialBloodGas[] Returns an array of ArterialBloodGas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArterialBloodGas
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
