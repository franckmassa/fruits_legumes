<?php

namespace App\DataFixtures;

use App\Entity\Type;
use App\Entity\Aliment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $t1 = new Type();
        $t1->setLibelle("Fruits")
            ->setImage("fruits.jpg");
        $t1->setCreatedAt(new \DateTime('now'));
        $manager->persist($t1);

        $t2 = new Type();
        $t2->setLibelle("Legumes")
            ->setImage("legumes.jpg");
        $t2->setCreatedAt(new \DateTime('now'));
        $manager->persist($t2);

    

        // On récupère le repository de la class Aliment
        $alimentRepository = $manager->getRepository(Aliment::class);

        // On récupère le nom de l'aliment dans la base de données
        $a1 = $alimentRepository->findOneBy(["nom" => "Patate"]);
        // On assigne le type à l'aliment
        $a1->setType($t2);
        // On persist
        $manager->persist($t2);

        $a2 = $alimentRepository->findOneBy(["nom" => "Tomate"]);
        $a2->setType($t2);
        $manager->persist($a2);


        $a3 = $alimentRepository->findOneBy(["nom" => "Pomme"]);
        $a3->setType($t1);
        $manager->persist($a3);
    
        $manager->flush();
    }
}
