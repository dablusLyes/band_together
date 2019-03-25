<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
      $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
          $user_admin = new User();
          $user_admin->setEmail('quidelantoine@gmail.com');

          $user_admin->setPassword($this->passwordEncoder->encodePassword(
              $user_admin,
              'michel'
          ));

          $manager->persist($user_admin);

<<<<<<< HEAD
          $names = ['michel', 'tartenpion', 'antoine', 'yoda', 'obiwan', 'frederic', 'faillot', 'macron', 'jeanphil', 'jeanfonce', 'jeancul'];
=======
          $names = ['michel', 'tartenpion', 'antoine', 'yoda', 'obiwan', 'frederic', 'faillot', 'macron','jeanphil'];
>>>>>>> 492545bb016927b8c7dd96222d8826e36a2dc563

          for ($i=0; $i < 100; $i++) {
            $name = $names[rand(0, count($names) - 1)].$i;
            $user = new User();
            $user->setEmail("$name@gmail.com");

            $user->setPassword($this->passwordEncoder->encodePassword(
                  $user,
                  'michel'
              ));
            $manager->persist($user);
          }


          $manager->flush();
    }
}
