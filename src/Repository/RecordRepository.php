<?php

namespace App\Repository;

use App\Application\Sonata\UserBundle\Entity\Group;
use App\Entity\Record;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializerInterface;

/**
 * @method Record|null find($id, $lockMode = null, $lockVersion = null)
 * @method Record|null findOneBy(array $criteria, array $orderBy = null)
 * @method Record[]    findAll()
 * @method Record[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecordRepository extends ServiceEntityRepository
{
    use AuditTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Record::class);
    }

    public function serializeRecord(Record $record, SerializerInterface $serializer)
    {
        $recordLogs = $this->audits($record);

        $relatedModels = [
            "vital_signs" => $record->getVitalSigns(),
            "triage" => $record->getTriage(),
            "serum_electrolytes" => $record->getSerumElectrolytes(),
            "blood_chemistry" => $record->getBloodChemistry(),
            "clotting_time" => $record->getClottingTime(),
            "immunological" => $record->getImmunological(),
            "medical_notes" => $record->getMedicalNotes(),
            "liver_function" => $record->getLiverFunction(),
            "imaging" => $record->getImaging(),
            "covid" => $record->getCovid(),
            "hematic_biometry" => $record->getHematicBiometry(),
            "cardiac_enzymes" => $record->getCardiacEnzymes(),
            "arterial_blood_gas" => $record->getArterialBloodGas(),
            "created_by" => $record->getCreatedBy(),
            "updated_by" => $record->getCreatedBy(),
        ];

        foreach ($relatedModels as $key => $model) {
            if ($model) {
                $recordLogs[$key] = $this->audits($model);
            }
        }

        return $serializer->serialize($recordLogs, 'json');
    }

    /**
     * @param \App\Application\Sonata\UserBundle\Entity\Group $group
     * @return \App\Entity\Record[]
     */
    public function findByGroup(Group $group)
    {
        $usersCollection = $group->getUsers();

        $userIds = $usersCollection->map(function ($item) {
            return $item->getId();
        });

        return $this->findBy(['created_by' => $userIds->toArray()]);
    }

    // /**
    //  * @return Record[] Returns an array of Record objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Record
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
