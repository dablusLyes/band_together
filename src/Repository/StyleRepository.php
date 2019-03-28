<?php

namespace App\Repository;

use App\Entity\Style;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Style|null find($id, $lockMode = null, $lockVersion = null)
 * @method Style|null findOneBy(array $criteria, array $orderBy = null)
 * @method Style[]    findAll()
 * @method Style[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StyleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Style::class);
    }

    public function countStyle()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT COUNT(s.id) FROM App\Entity\Style s');
        $count = $query->getSingleScalarResult();
        return $count;
    }

    public function selectManyStyle($off, $lim = 10)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT s FROM
                                  App\Entity\Style s
                                  ORDER BY s.id ASC')
                                  ->setFirstResult($off)
                                  ->setMaxResults($lim);

        return $query->getResult();
    }

    // /**
    //  * @return Style[] Returns an array of Style objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Style
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
