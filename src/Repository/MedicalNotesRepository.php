<?php

namespace App\Repository;

use App\Entity\MedicalNotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MedicalNotes|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicalNotes|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicalNotes[]    findAll()
 * @method MedicalNotes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicalNotesRepository extends ServiceEntityRepository
{
    use AuditTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MedicalNotes::class);
    }

    // /**
    //  * @return MedicalNotes[] Returns an array of MedicalNotes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MedicalNotes
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
