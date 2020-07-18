<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture {

    public function load(ObjectManager $manager) {
        $a1 = new Aliment();
        $a1->setNom("Carotte")
                ->setPrix(1.80)
                ->setCalorie(36)
                ->setImage("aliments/carotte.png")
                ->setProteine(0.77)
                ->setGlucide(6.45)
                ->setLipide(0.26);
        $a1->setUpdatedAt(new \DateTime('now'));
        $manager->persist($a1);

        $a2 = new Aliment();
        $a2->setNom("Patate")
                ->setPrix(1.45)
                ->setCalorie(45)
                ->setImage("aliments/patate.jpg")
                ->setProteine(3.5)
                ->setGlucide(7.56)
                ->setLipide(0.50);
        $a2->setUpdatedAt(new \DateTime('now'));
        $manager->persist($a2);

        $a3 = new Aliment();
        $a3->setNom("Pomme")
                ->setPrix(2.45)
                ->setCalorie(34)
                ->setImage("aliments/pomme.png")
                ->setProteine(10.60)
                ->setProteine(10.60)
                ->setGlucide(3.80)
                ->setLipide(040);
        $a3->setUpdatedAt(new \DateTime('now'));
        $manager->persist($a3);

        $a4 = new Aliment();
        $a4->setNom("Tomate")
                ->setPrix(3.40)
                ->setCalorie(15.80)
                ->setImage("aliments/tomate.png")
                ->setProteine(2)
                ->setGlucide(2.90)
                ->setLipide(0.45);
        $a4->setUpdatedAt(new \DateTime('now'));
        $manager->persist($a4);

        $manager->flush();
     }

}
