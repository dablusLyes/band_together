<?php

namespace App\Repository;

use App\Entity\UsersInstruments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UsersInstruments|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersInstruments|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersInstruments[]    findAll()
 * @method UsersInstruments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersInstrumentsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UsersInstruments::class);
    }

    // /**
    //  * @return UsersInstruments[] Returns an array of UsersInstruments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsersInstruments
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
