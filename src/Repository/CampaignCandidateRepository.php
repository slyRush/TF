<?php

namespace App\Repository;

use App\Entity\CampaignCandidate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CampaignCandidate|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampaignCandidate|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampaignCandidate[]    findAll()
 * @method CampaignCandidate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampaignCandidateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CampaignCandidate::class);
    }

    // /**
    //  * @return CampaignCandidate[] Returns an array of CampaignCandidate objects
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
    public function findOneBySomeField($value): ?CampaignCandidate
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
