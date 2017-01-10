<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Entity\Categorie;
use Admin\AdminBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{
    public function breadcrumbAction( $request )
    {
        $zRouteName = $request->get('_route');

        if ( preg_match("#utilisateur#i", $zRouteName) ) {
            return $this->render('AdminAdminBundle:Admin:breadcrumb.html.twig', array(
                'icone_name' => 'fa-user-o',
                'icone_text' => 'Utilisateurs'
            ));
        }
        elseif ( preg_match("#categorie#i", $zRouteName) )
        {
            return $this->render('AdminAdminBundle:Admin:breadcrumb.html.twig', array(
                'icone_name' => 'fa-folder-o',
                'icone_text' => 'Categories'
            ));
        }
        elseif ( preg_match("#produit#i", $zRouteName) )
        {
            return $this->render('AdminAdminBundle:Admin:breadcrumb.html.twig', array(
                'icone_name' => 'fa-shopping-cart',
                'icone_text' => 'Produits'
            ));
        }
        else
        {
            return $this->render('AdminAdminBundle:Admin:breadcrumb.html.twig', array(
                'icone_name' => 'fa-folder-o',
                'icone_text' => 'Icone'
            ));
        }

    }

    public function menuAction( $request )
    {
        $zRouteName = $request->get('_route');

        if ( preg_match("#utilisateur#i", $zRouteName) ) {
            return $this->render('AdminAdminBundle:Admin:menu.html.twig', array(
                'class_utilisateur' => 'active',
                'class_produit'     => '',
                'class_categorie'   => ''
            ));
        }
        elseif ( preg_match("#categorie#i", $zRouteName) ) {
            return $this->render('AdminAdminBundle:Admin:menu.html.twig', array(
                'class_utilisateur' => '',
                'class_produit'     => '',
                'class_categorie'   => 'active'
            ));
        }
        else
        {
            return $this->render('AdminAdminBundle:Admin:menu.html.twig', array(
                'class_utilisateur' => '',
                'class_produit'     => 'active',
                'class_categorie'   => ''
            ));
        }

    }
}
