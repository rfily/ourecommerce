<?php

namespace Admin\AdminBundle\Subscriber;

use Admin\AdminBundle\Entity\Produit;
use Admin\AdminBundle\Entity\OurLogger;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;


class ProduitSubscriber implements EventSubscriber
{
    private $container;

    /**
     * CategorieSubscriber constructor.
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getSubscribedEvents()
    {
        return array(
            'postRemove',
            'postPersist',
            'postUpdate'
        );
    }

    public function postRemove(LifecycleEventArgs $args )
    {
        $oEntity    = $args->getEntity();
        $oEm        = $args->getEntityManager();
        $oUser      = $this->container->get('security.context')->getToken()->getUser();



        if ($oEntity instanceof Produit)
        {
            $oLogger = new OurLogger();
            $oLogger->setDate(new \Datetime());
            $oLogger->setAction('SUPPRESSION');
            $oLogger->setUser($oUser->getId());
            $oLogger->setObjet('Produit');

            $oEm->persist($oLogger);
            $oEm->flush();
        }
    }

    public function postPersist(LifecycleEventArgs $args )
    {
        $oEntity    = $args->getEntity();
        $oEm        = $args->getEntityManager();
        $oUser      = $this->container->get('security.context')->getToken()->getUser();



        if ($oEntity instanceof Produit)
        {
            $oLogger = new OurLogger();
            $oLogger->setDate(new \Datetime());
            $oLogger->setAction('AJOUT');
            $oLogger->setUser($oUser->getId());
            $oLogger->setObjet('Produit');

            $oEm->persist($oLogger);
            $oEm->flush();
        }
    }

    public function postUpdate(LifecycleEventArgs $args )
    {
        $oEntity    = $args->getEntity();
        $oEm        = $args->getEntityManager();
        $oUser      = $this->container->get('security.context')->getToken()->getUser();



        if ($oEntity instanceof Produit)
        {
            $oLogger = new OurLogger();
            $oLogger->setDate(new \Datetime());
            $oLogger->setAction('EDITION');
            $oLogger->setUser($oUser->getId());
            $oLogger->setObjet('Produit');

            $oEm->persist($oLogger);
            $oEm->flush();
        }
    }
}