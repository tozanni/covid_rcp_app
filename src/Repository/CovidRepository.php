<?php

namespace App\Repository;

use App\Entity\Covid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Covid|null find($id, $lockMode = null, $lockVersion = null)
 * @method Covid|null findOneBy(array $criteria, array $orderBy = null)
 * @method Covid[]    findAll()
 * @method Covid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CovidRepository extends ServiceEntityRepository
{
    use AuditTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Covid::class);
    }

    // /**
    //  * @return Covid[] Returns an array of Covid objects
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
    public function findOneBySomeField($value): ?Covid
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
