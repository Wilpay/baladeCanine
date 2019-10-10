<?php

namespace App\Repository;

use App\Entity\ProfilAnimal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProfilAnimal|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfilAnimal|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfilAnimal[]    findAll()
 * @method ProfilAnimal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfilAnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfilAnimal::class);
    }

    // /**
    //  * @return ProfilAnimal[] Returns an array of ProfilAnimal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findOneById($value): ?ProfilAnimal
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.animal = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
