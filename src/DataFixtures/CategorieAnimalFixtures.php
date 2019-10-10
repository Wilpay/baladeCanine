<?php


namespace App\DataFixtures;


use App\Entity\CategorieAnimal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategorieAnimalFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $categ1 = new CategorieAnimal();
        $categ1->setLibelle('Chien');

        $categ2 = new CategorieAnimal();
        $categ2->setLibelle('Chat');

        $categ3 = new CategorieAnimal();
        $categ3->setLibelle('Rongeur');

        $categ4 = new CategorieAnimal();
        $categ4->setLibelle('Poisson');

        $manager->persist($categ1);
        $manager->persist($categ2);
        $manager->persist($categ3);
        $manager->persist($categ4);

        $manager->flush();


    }
}