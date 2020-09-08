<?php

namespace App\Repository;

use App\Entity\Imaging;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Imaging|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imaging|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imaging[]    findAll()
 * @method Imaging[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagingRepository extends ServiceEntityRepository
{
    use AuditTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imaging::class);
    }

    // /**
    //  * @return Imaging[] Returns an array of Imaging objects
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
    public function findOneBySomeField($value): ?Imaging
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
