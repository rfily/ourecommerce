<?php
/**
 * Created by PhpStorm.
 * User: Niaina
 * Date: 10/01/2017
 * Time: 07:41
 */

namespace Admin\AdminBundle\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddEnabledFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'onPresetData'
        );
    }

    public function onPresetData( FormEvent $event )
    {
        $oUser  = $event->getData();
        $oForm  = $event->getForm();

        if ( !$oUser || !$oUser->hasRole("ROLE_ADMIN") )
        {
            $oForm->add('enabled',null, array('label'=>'Actif', 'translation_domain' => 'FOSUserBundle'));
        }

    }
}