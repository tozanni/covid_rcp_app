<?php

namespace App\Repository;

use App\Entity\CardiacEnzymes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CardiacEnzymes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardiacEnzymes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardiacEnzymes[]    findAll()
 * @method CardiacEnzymes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardiacEnzymesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardiacEnzymes::class);
    }

    // /**
    //  * @return CardiacEnzymes[] Returns an array of CardiacEnzymes objects
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
    public function findOneBySomeField($value): ?CardiacEnzymes
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
