<?php

namespace App\Repository;

use App\Entity\HematicBiometry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HematicBiometry|null find($id, $lockMode = null, $lockVersion = null)
 * @method HematicBiometry|null findOneBy(array $criteria, array $orderBy = null)
 * @method HematicBiometry[]    findAll()
 * @method HematicBiometry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HematicBiometryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HematicBiometry::class);
    }

    // /**
    //  * @return HematicBiometry[] Returns an array of HematicBiometry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HematicBiometry
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
