<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Entity\Produit;
use Admin\AdminBundle\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProduitController extends Controller
{
    public function listerAction($page, $idCategorie)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbParPage = 10;

        $em = $this->getDoctrine()->getEntityManager();
        if(isset($idCategorie))
        {
            $produits  = $em->getRepository('AdminAdminBundle:Produit')->findByCategorieId($idCategorie, $page, $nbParPage);
        }
        else
        {
            $produits = $em->getRepository('AdminAdminBundle:Produit')->getProduits($page, $nbParPage);
        }

        $nbPages = ceil(count($produits)/$nbParPage);

        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $categories = $em->getRepository('AdminAdminBundle:Categorie')->findAll();

        return $this->render('@AdminAdmin/Produit/lister.html.twig', array(
            'produits'   => $produits,
            'categories' => $categories,
            'selectedId' => $idCategorie,
            'nbPages'    => $nbPages,
            'page'       => $page
        ));
    }

    public function ajouterAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm(new ProduitType(), $produit);

        if($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Produit bien enregistrée.');

            return $this->redirectToRoute('admin_admin_produits');
        }
        return $this->render('@AdminAdmin/Produit/ajouter.html.twig', array(
            'form_ajout' => $form->createView()
        ));
    }

    public function modifierAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('AdminAdminBundle:Produit')->find($id);

        if($produit === null)
        {
            throw new NotFoundHttpException("Le produit d'id ".$id." n'existe pas.");
        }

        $form = $this->createForm(new ProduitType(), $produit);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Produit bien modifiée.');
            return $this->redirectToRoute('admin_admin_produits');
        }

        return $this->render('AdminAdminBundle:Produit:modifier.html.twig', array(
            'form_modif' => $form->createView()
        ));
    }
    
    public function supprimerAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('AdminAdminBundle:Produit')->find($id);

        if($produit === null)
        {
            throw new NotFoundHttpException("Le produit d'id ".$id." n'existe pas.");
        }

        $em->remove($produit);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Catégorie bien supprimée');
        return $this->redirectToRoute('admin_admin_produits');
    }

}
