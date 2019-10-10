<?php

namespace App\Repository;

use App\Entity\Caractere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Caractere|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caractere|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caractere[]    findAll()
 * @method Caractere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaractereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caractere::class);
    }

    // /**
    //  * @return Caractere[] Returns an array of Caractere objects
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
    public function findOneBySomeField($value): ?Caractere
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
