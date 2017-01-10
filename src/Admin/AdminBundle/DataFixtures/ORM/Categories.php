<?php
/**
 * Created by PhpStorm.
 * User: RINDRA
 * Date: 09/01/2017
 * Time: 15:13
 */

namespace Admin\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Admin\AdminBundle\Entity\Categorie;

class Categories extends AbstractFixture  implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categorie();
        $categorie1->setNom('PC')
            ->setDescription('Categorie parent des ordinateurs')
        ;
        $this->addReference('categorie-PC', $categorie1);

        $categorie2 = new Categorie();
        $categorie2->setNom('PC Portable')
            ->setDescription('Sous catégorie de la catégorie PC')
            ->setParent($categorie1);
        $this->addReference('categorie-PC_Portable', $categorie2);

        $categorie3 = new Categorie();
        $categorie3->setNom('PC de Bureau')
            ->setDescription('Sous catégorie de la catégorie PC')
            ->setParent($categorie1)
        ;
        $this->addReference('categorie-PC_de_Bureau', $categorie3);

        $categorie4 = new Categorie();
        $categorie4->setNom('Telephone')
            ->setDescription('Pas de sous catégorie')
        ;
        $this->addReference('categorie-Telephone', $categorie4);

        $manager->persist($categorie1);
        $manager->persist($categorie2);
        $manager->persist($categorie3);
        $manager->persist($categorie4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}