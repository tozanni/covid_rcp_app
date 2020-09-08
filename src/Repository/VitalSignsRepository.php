<?php

namespace App\Repository;

use App\Entity\VitalSigns;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VitalSigns|null find($id, $lockMode = null, $lockVersion = null)
 * @method VitalSigns|null findOneBy(array $criteria, array $orderBy = null)
 * @method VitalSigns[]    findAll()
 * @method VitalSigns[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VitalSignsRepository extends ServiceEntityRepository
{
    use AuditTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VitalSigns::class);
    }

    // /**
    //  * @return VitalSigns[] Returns an array of VitalSigns objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VitalSigns
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
