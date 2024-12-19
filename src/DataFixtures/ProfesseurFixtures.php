<?php

namespace App\DataFixtures;

use App\Entity\Module;
use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfesseurFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $grades=["Docteur","Master","Technicien","Ingénieur"];
     

        for ($i=1; $i < 11; $i++) { 
            $data=new Professeur;
            $data->setNomComplet("Professeur".$i);
            $randGrade=rand(0,3);
            $randModule=rand(0,4);
            $data->setNci(uniqid())
                  ->setGrade($grades[$randGrade])
                  ->setEmail(strtolower("professeur").$i."@gmail.com");
            $plainPassword="passer@123";
           $passwordEncode= $this->encoder->hashPassword($data,$plainPassword);
           $data->setPassword($passwordEncode);
           //Ajouter les Modules d'un Professeur
           for ($j=0; $j <= $randModule; $j++){
               $data->addModule($this->getReference("Module".$j));
           }

           $this->addReference("Professeur".$i, $data);
           $manager->persist($data);  
        }

        $manager->flush();
    }
    public function getDependencies()
    {
         return[
            ModuleFixtures::class
         ] ;
    }
}
