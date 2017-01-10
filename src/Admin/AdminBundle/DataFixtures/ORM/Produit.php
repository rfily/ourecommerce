<?php
/**
 * Created by PhpStorm.
 * User: RINDRA
 * Date: 09/01/2017
 * Time: 16:23
 */

namespace Admin\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Admin\AdminBundle\Entity\Produit as EntityProduit;


class Produit extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $produit1 = new EntityProduit();
        $produit1->setNom('HP Pavilion')
            ->setDescription('Ordinateur portable de long autonomie')
            ->setActif(true)
            ->setPrix(600)
            ->addCategory($this->getReference('categorie-PC'))
            ->addCategory($this->getReference('categorie-PC_Portable'))
        ;

        $produit2 = new EntityProduit();
        $produit2->setNom('alienware')
            ->setDescription('Ordinateur puissant pour gamer')
            ->setActif(true)
            ->setPrix(500)
            ->addCategory($this->getReference('categorie-PC'))
            ->addCategory($this->getReference('categorie-PC_de_Bureau'))
        ;

        $produit3 = new EntityProduit();
        $produit3->setNom('iphone 7')
            ->setDescription('smartphone')
            ->setActif(true)
            ->setPrix(800)
            ->addCategory($this->getReference('categorie-Telephone'))
        ;

        $produit4 = new EntityProduit();
        $produit4->setNom('samsung galaxy s7')
            ->setDescription('smartphone')
            ->setPrix(600)
            ->setActif(true)
            ->addCategory($this->getReference('categorie-Telephone'))
        ;

        $produit5 = new EntityProduit();
        $produit5->setNom('chapeau')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;

        $produit6 = new EntityProduit();
        $produit6->setNom('banane')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;

        $produit7 = new EntityProduit();
        $produit7->setNom('pantalon')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;

        $produit8 = new EntityProduit();
        $produit8->setNom('biscuit')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;

        $produit9 = new EntityProduit();
        $produit9->setNom('bonbon')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;

        $produit10 = new EntityProduit();
        $produit10->setNom('salade')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;

        $produit11 = new EntityProduit();
        $produit11->setNom('carotte')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;

        $produit12 = new EntityProduit();
        $produit12->setNom('chemise')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;

        $produit13 = new EntityProduit();
        $produit13->setNom('riz')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;

        $produit14 = new EntityProduit();
        $produit14->setNom('spagetti')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;

        $produit15 = new EntityProduit();
        $produit15->setNom('lunette')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;

        $produit16 = new EntityProduit();
        $produit16->setNom('efferarlgant')
            ->setDescription('pas de catégorie')
            ->setPrix(5)
            ->setActif(true)
        ;
        $manager->persist($produit1);
        $manager->persist($produit2);
        $manager->persist($produit3);
        $manager->persist($produit4);
        $manager->persist($produit5);
        $manager->persist($produit6);
        $manager->persist($produit7);
        $manager->persist($produit8);
        $manager->persist($produit9);
        $manager->persist($produit10);
        $manager->persist($produit11);
        $manager->persist($produit12);
        $manager->persist($produit13);
        $manager->persist($produit14);
        $manager->persist($produit15);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}