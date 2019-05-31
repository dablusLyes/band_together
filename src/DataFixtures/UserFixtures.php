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
          $user_admin->setUsername('Michel');
          $user_admin->setEmail('quidelantoine@gmail.com');
          $user_admin->setCreatedAt(new \Datetime);

          $user_admin->setPassword($this->passwordEncoder->encodePassword(
              $user_admin,
              'michel'
          ));

          $user_admin->setRoles(['ROLE_SUPER_ADMIN']);
          $user_admin->setToken();

          $manager->persist($user_admin);

          $names = ['michel', 'tartenpion', 'antoine', 'yoda', 'obiwan', 'frederic', 'faillot', 'macron','jeanphil', 'tartine'];

          for ($i=0; $i < 100; $i++) {
            $name = $names[rand(0, count($names) - 1)].$i;
            $user = new User();
            $user->setUsername($name);
            $user->setEmail("$name@gmail.com");
            $user->setCreatedAt(new \Datetime);

            $user->setPassword($this->passwordEncoder->encodePassword(
                  $user,
                  'michel'
              ));

            $user->setToken();

            $manager->persist($user);
          }


          $manager->flush();
    }
}
