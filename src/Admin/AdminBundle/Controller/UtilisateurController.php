<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Entity\Utilisateur;
use Admin\AdminBundle\Form\UtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UtilisateurController extends Controller
{
    public function indexAction()
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('AdminAdminBundle:Utilisateur:index.html.twig', array('users' => $users));
    }

    public function ajoutAction()
    {
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->createUser();

        $oTheform = $this->createForm(new UtilisateurType(), $user);

        $oRequest   = $this->get('request');

        $oTheform->handleRequest($oRequest);

        if ($oTheform->isSubmitted() )
        {
            if($oTheform->isValid())
            {

                $user->addRole("ROLE_USER");

                $userManager->updateUser($user);

                $this->get('session')->getFlashBag()->add('info', 'L\'utilisateur a bien été ajouté');

                return $this->redirect($this->generateUrl('admin_admin_utilisateur'));
            }
        }

        return $this->render('AdminAdminBundle:Utilisateur:ajouter.html.twig',
            array('formajout' => $oTheform->createView())
        );
    }

    public function modifAction( $id )
    {
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserBy( array('id' => $id) );

        $oTheform = $this->createForm(new UtilisateurType(), $user);

        $oRequest   = $this->get('request');

        $oTheform->handleRequest($oRequest);

        if ($oTheform->isSubmitted() )
        {
            if($oTheform->isValid())
            {
                if ( $user->hasRole("ROLE_ADMIN") )
                    $user->setEnabled(1);

                $userManager->updateUser($user);


                $this->get('session')->getFlashBag()->add('info', 'L\'utilisateur a bien été modifié');

                return $this->redirect($this->generateUrl('admin_admin_utilisateur'));
            }
        }

        return $this->render('AdminAdminBundle:Utilisateur:modifier.html.twig',
            array('formmodif' => $oTheform->createView(), 'user' => $user)
        );
    }

    public function supprAction( $id )
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserBy( array('id' => $id) );
        $userManager->deleteUser($user);

        $this->get('session')->getFlashBag()->add('info', 'L\'Utilisateur a bien été supprimé');

        return $this->redirect($this->generateUrl('admin_admin_utilisateur'));
    }
}
