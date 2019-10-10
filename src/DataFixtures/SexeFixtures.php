<?php


namespace App\DataFixtures;


use App\Entity\Sexe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SexeFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $sexe1 = new Sexe();
        $sexe1->setNature('Homme');

        $sexe2 = new Sexe();
        $sexe2->setNature('Femme');

        $manager->persist($sexe1);
        $manager->persist($sexe2);

        $manager->flush();
    }
}