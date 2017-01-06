<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('code d\'activation compte Ariary.net')
            ->setFrom('niaina.bocasay@gmail.com')
            ->setTo('nrakotoniary@bocasay.fr')
            ->setBody('test envoie email');
        ;
        $this->get('mailer')->send($message);
        return $this->render('AdminAdminBundle:Default:index.html.twig');
    }
}
