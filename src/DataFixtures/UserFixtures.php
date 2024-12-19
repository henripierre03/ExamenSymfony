<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $roles=["ROLE_RP","ROLE_AC"];
        foreach ($roles as $libelle) {
            $data=new User;
            $data->setNomComplet($libelle)
                  ->setEmail(strtolower($libelle)."@gmail.com")
                  ->setRoles([$libelle]);
            $plainPassword="passer@123";
           $passwordEncode= $this->encoder->hashPassword($data,$plainPassword);
           $data->setPassword($passwordEncode);
           $manager->persist($data);
        }

        $manager->flush();
    }
}
