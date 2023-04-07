<?php

namespace App\DataFixtures;
use Faker;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface) 
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $users = array();
        for ($i = 0; $i < 3; $i++) {
            $users[$i] = new User();
            $users[$i]->setLastName($faker->lastName);
            $users[$i]->setFirstName($faker->firstName);
            $users[$i]->setEmail($faker->email);
            $users[$i]->setPassword(
                $this->userPasswordHasherInterface->hashPassword(
                    $users[$i], $faker->password
                )
            );

            $manager->persist($users[$i]);
        }

        $user = new User();
        $user->setLastName($faker->lastName);
        $user->setFirstName($faker->firstName);
        $user->setEmail('faty@email.fr');
        $user->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $user, "passer"
            )
        );

        $manager->persist($user);

        $manager->flush();
    }
}
