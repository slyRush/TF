<?php

namespace App\Repository;

use App\Entity\ContactUsEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContactUsEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactUsEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactUsEmail[]    findAll()
 * @method ContactUsEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactUsEmailRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContactUsEmail::class);
    }

    // /**
    //  * @return ContactUsEmail[] Returns an array of ContactUsEmail objects
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
    public function findOneBySomeField($value): ?ContactUsEmail
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
