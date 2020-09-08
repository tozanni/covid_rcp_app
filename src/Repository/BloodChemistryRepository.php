<?php

namespace App\Repository;

use App\Entity\BloodChemistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BloodChemistry|null find($id, $lockMode = null, $lockVersion = null)
 * @method BloodChemistry|null findOneBy(array $criteria, array $orderBy = null)
 * @method BloodChemistry[]    findAll()
 * @method BloodChemistry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodChemistryRepository extends ServiceEntityRepository
{
    use AuditTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BloodChemistry::class);
    }

    // /**
    //  * @return BloodChemistry[] Returns an array of BloodChemistry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BloodChemistry
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
