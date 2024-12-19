<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EtudiantFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 21; $i++) { 
            $data=new Etudiant;
            $data->setNomComplet("Etudiant".$i);
            $data->setMatricule(uniqid())
                  ->setTuteur("Tuteur".$i)
                  ->setEmail(strtolower("etudiant").$i."@gmail.com");
            $plainPassword="passer@123";
           $passwordEncode= $this->encoder->hashPassword($data,$plainPassword);
           $data->setPassword($passwordEncode);
           $this->addReference("Etudiant".$i, $data);
           $manager->persist($data);  
        }

        $manager->flush();
    }
}
