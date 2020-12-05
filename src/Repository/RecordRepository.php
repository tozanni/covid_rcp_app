<?php

namespace App\Repository;

use App\Application\Sonata\UserBundle\Entity\Group;
use App\Entity\Record;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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
     * @param QueryBuilder $qb
     * @param Group $hospital
     * @return QueryBuilder
     */
    protected function addFilterByHospital(QueryBuilder $qb, Group $hospital): QueryBuilder
    {
        $usersCollection = $hospital->getUsers();

        $userIds = $usersCollection->map(function ($item) {
            return $item->getId();
        })->toArray();

        return $qb->add('where', $qb->expr()->in('r.created_by', $userIds));
    }

    /**
     * @param Group $hospital
     * @return int|mixed|string
     */
    public function findByHospital(Group $hospital)
    {
        $qb = $this->createQueryBuilder('r');

        return $this->addFilterByHospital($qb, $hospital)
            ->getQuery()->getResult();
    }

    protected function addFilterByIdOrCanonicalId(QueryBuilder $qb, $value)
    {
        if (preg_match('/[a-f0-9]{8}\-[a-f0-9]{4}\-4[a-f0-9]{3}\-(8|9|a|b)[a-f0-9]{3}\-[a-f0-9]{12}/', $value)){
            $qb = $qb->andWhere("r.id = '{$value}'");
        } else {
            $qb = $qb->andWhere("r.id_canonical like '%{$value}%'");
        }

        return $qb;
    }

    public function findByHospitalAndId(Group $hospital, $id)
    {
        $qb = $this->createQueryBuilder('r');
        $qb = $this->addFilterByHospital($qb, $hospital);

        return $this->addFilterByIdOrCanonicalId($qb, $id);
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
