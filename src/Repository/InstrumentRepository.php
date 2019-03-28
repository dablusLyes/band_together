<?php

namespace App\Repository;

use App\Entity\Instrument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Instrument|null find($id, $lockMode = null, $lockVersion = null)
 * @method Instrument|null findOneBy(array $criteria, array $orderBy = null)
 * @method Instrument[]    findAll()
 * @method Instrument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstrumentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Instrument::class);
    }

    public function countInstrument()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT COUNT(i.id) FROM App\Entity\Instrument i');
        $count = $query->getSingleScalarResult();
        return $count;
    }

    public function selectManyInstrument($off, $lim = 10)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT i FROM
                                  App\Entity\Instrument i
                                  ORDER BY i.id ASC')
                                  ->setFirstResult($off)
                                  ->setMaxResults($lim);

        return $query->getResult();
    }

    // /**
    //  * @return Instrument[] Returns an array of Instrument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Instrument
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
