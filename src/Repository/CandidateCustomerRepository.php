<?php

namespace App\Repository;

use App\Entity\CandidateCustomer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CandidateCustomer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidateCustomer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidateCustomer[]    findAll()
 * @method CandidateCustomer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateCustomerRepository extends ServiceEntityRepository
{
    /**
     * CandidateCustomerRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CandidateCustomer::class);
    }

    // /**
    //  * @return CandidateCustomer[] Returns an array of CandidateCustomer objects
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
    public function findOneBySomeField($value): ?CandidateCustomer
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
