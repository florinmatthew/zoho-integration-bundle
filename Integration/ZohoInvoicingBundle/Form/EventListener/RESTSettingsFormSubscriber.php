<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Oro\Bundle\FormBundle\Utils\FormUtils;
use Oro\Bundle\SecurityBundle\Encoder\Mcrypt;
/**
 * Description of RESTSettingsFormSubscriber
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class RESTSettingsFormSubscriber implements EventSubscriberInterface {
    
    protected $encrypt;
    
    function __construct(Mcrypt $mcrypt) {
        $this->encrypt = $mcrypt;
    }
    
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSet',
            FormEvents::PRE_SUBMIT   => 'preSubmit'
        ];
    }
    
    /**
     * 
     * @param FormEvent $event
     * @return type
     */
    public function preSet(FormEvent $event){
        $form = $event->getForm();
        $data = $event->getData();

        if ($data === null) {
            return;
        }
        
        $modifier = $this->getModifierOrganizationsList($data->getOrganizations());
        $modifier($form);
    }
    
    public function preSubmit(FormEvent $event){
        $data = (array)$event->getData();
        $form = $event->getForm();
        
        if (!empty($data['organizations'])) {
            $organizations = $data['organizations'];
            // reverseTransform, but not set back to event
            if (!is_array($organizations)) {
                $organizations = json_decode($organizations, true);
            }
            $modifier = $this->getModifierOrganizationsList($organizations);
            $modifier($form);
        }

        $event->setData($data);
    }
    
    /**
     * 
     * @param type $organizations
     */
    private function getModifierOrganizationsList($organizations){
        return function(FormInterface $form) use ($organizations){
            if(empty($organizations)) return;
            
            $choices = [];
            foreach ($organizations as $organization) {
                $choices[$organization['organization_id']] = $organization['name'];
            }
                
            FormUtils::replaceField($form, 'organization_idvalue', ['choices' => $choices], ['choice_list']);
        };
    }
    
}
