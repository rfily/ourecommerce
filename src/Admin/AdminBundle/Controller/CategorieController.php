<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Entity\Categorie;
use Admin\AdminBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends Controller
{
    public function listerAction()
    {
        $repository = $this->getDoctrine()->getEntityManager()->getRepository('AdminAdminBundle:Categorie');
        $categories = $repository->findAll();
        return $this->render('@AdminAdmin/Categorie/index.html.twig', array(
            'categories' => $categories
        ));
    }

    public function ajouterAction(Request $request)
    {
        $categorie = new Categorie();
        $form = $this->createForm(new CategorieType(), $categorie);

        if($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('admin_admin_categorie');
        }
        return $this->render('@AdminAdmin/Categorie/ajouter.html.twig', array(
            'formajout' => $form->createView()
        ));
    }
}
