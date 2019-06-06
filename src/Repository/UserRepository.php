<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use phpDocumentor\Reflection\Types\Null_;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function countUser()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT COUNT(u.id) FROM App\Entity\User u');
        $count = $query->getSingleScalarResult();
        return $count;
    }

    public function selectManyUser($off, $lim = 10)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT u FROM
                                  App\Entity\User u
                                  ORDER BY u.created_at ASC')
                                  ->setFirstResult($off)
                                  ->setMaxResults($lim);

        return $query->getResult();
    }

    /**
    * @return User[] Returns an array of the 10 last users with a departement set in their profile for the homepage
    */

    public function findByLastUserWithDepartement()
    {
        return $this->createQueryBuilder('u')
            ->where('u.departement IS NOT NULL')
            ->orderBy('u.created_at', 'DESC')
            ->setMaxResults(12)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findUsersAround($departement)
    {
        return $this->createQueryBuilder('u')
            ->Where('u.departement = :val')
            ->setParameter('val', $departement)
            ->orderBy('u.created_at', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findLastUsers()
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.created_at', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }


    public function getUserInstruAndDepartement($instru_id,$departement_id)
    {
      $query = $this->createQueryBuilder('u');
      //$query->select('COUNT(a)');
      $query->leftJoin('u.instruments', 'i');
      $query->where('i.id = :instru'); /* i have guessed a.name */
      $query->andWhere('u.departement = :dep'); /* i have guessed a.name */
      $query->setParameter('instru', $instru_id);
      $query->setParameter('dep', $departement_id);



      return $query->getQuery()->getResult();
      //return $query->getResult();

    }


    // /**
    //  * @return User[] Returns an array of User objects
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
    public function findOneBySomeField($value): ?User
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
