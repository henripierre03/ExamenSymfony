<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $modules=["PHP","SYMFONY","JAVA","C#","UML"];
        foreach ( $modules as $i => $module) {
            $data=new Module();
            $data->setLibelle($module);
            $this->addReference("Module".$i, $data);
            $manager->persist($data);  
        }
        $manager->flush();
    }
}
