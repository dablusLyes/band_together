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

          // $departement1 = new Departements();
          // $departement1->setNom('Var');
          // $manager->persist($departement1);

          // $departement2 = new Departements();
          // $departement2->setNom('Vaucluse');
          // $manager->persist($departement2);

          // $departement3 = new Departements();
          // $departement3->setNom('Eure');
          // $manager->persist($departement3);

          // $departement4 = new Departements();
          // $departement4->setNom('Haute-Normandie');
          // $manager->persist($departement4);

          $names = ['Michael', 'Kurt', 'Antoine', 'Rémi', 'Valentin', 'Fred', 'Lyes', 'Jérémy','Jean', 'John', 'Paul', 'George', 'Ringo', 'Jacques', 'Lana', 'Daniel', 'Celine', 'Mylene', 'Camille', 'Chloé'];

          for ($i=0; $i < 20; $i++) {
            $name = $names[$i];
            $user = new User();
            $user->setUsername($name);
            // $user->setDepartement($departement1);
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
