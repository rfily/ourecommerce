<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $oUser      = $this->container->get('security.context')->getToken()->getUser();
dump($oUser->getId());exit;
        return $this->render('AdminAdminBundle:Default:index.html.twig');
    }
}
