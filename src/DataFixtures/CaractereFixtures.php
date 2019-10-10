<?php


namespace App\DataFixtures;


use App\Entity\Caractere;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CaractereFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $caractere1 = new Caractere();
        $caractere1->setLibelle('Joueur');

        $caractere2 = new Caractere();
        $caractere2->setLibelle('Agressif');

        $caractere3 = new Caractere();
        $caractere3->setLibelle('Dominant');

        $caractere4 = new Caractere();
        $caractere4->setLibelle('Craintif');



        $manager->persist($caractere1);
        $manager->persist($caractere2);
        $manager->persist($caractere3);
        $manager->persist($caractere4);
        $manager->flush();

    }
}