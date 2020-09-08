<?php

namespace App\Repository;

use App\Entity\Immunological;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Immunological|null find($id, $lockMode = null, $lockVersion = null)
 * @method Immunological|null findOneBy(array $criteria, array $orderBy = null)
 * @method Immunological[]    findAll()
 * @method Immunological[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImmunologicalRepository extends ServiceEntityRepository
{
    use AuditTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Immunological::class);
    }

    // /**
    //  * @return Immunological[] Returns an array of Immunological objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Immunological
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
