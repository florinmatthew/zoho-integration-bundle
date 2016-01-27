<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Integration\ZohoInvoicingBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;
use Oro\Bundle\IntegrationBundle\Manager\TypesRegistry;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Oro\Bundle\FormBundle\Form\DataTransformer\ArrayToJsonTransformer;
use Integration\ZohoInvoicingBundle\Form\EventListener\RESTSettingsFormSubscriber;
/**
 * Description of RESTransportType
 *
 * @author Florian Matthew
 */
class RESTransportSettingsType extends AbstractType{
    
    const NAME = "zoho_integration_rest_transport_setting_form_type";
    
    /**
     *
     * @var type 
     */
    private $transport;
    
    /** @var SoapSettingsFormSubscriber */
    protected $subscriber;

    /** @var TypesRegistry */
    protected $registry;
    
    public function __construct(TransportInterface $transport, RESTSettingsFormSubscriber $subscriber,TypesRegistry $registry){
        $this->transport = $transport;
        $this->subscriber = $subscriber;
        $this->registry = $registry;
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->addEventSubscriber($this->subscriber);
        
        $builder->add('auth_api_url', 
                'url', ['required' => true]); // invoice_api_url
        $builder->add('scope', 
                'choice', ['choices' => ['ZohoInvoice/invoiceapi' => 'ZohoInvoice/invoiceapi'], 'required' => true]);
        $builder->add('email', 
                'email', ['required' => true]);
        $builder->add('password', 
                'password', ['required' => true]);
        
        /**
         * Check connection and get api token. 
         */
        
        $builder->add('check', 
                'integration_zohoinvoicingbundle_rest_transport_check_button', 
                ['label' => 'Check ZohoCRM connection']);
        
        $builder->add('auth_token', 
                'text', ['required' => true]);
        $builder->add('api_url', 
                'url', ['required' => true]);
        
        $builder->add('organization_idvalue', 'zoho_integration_rest_transport_organization_select', 
            [
                'label'    => 'Select company',
                'required' => true
            ]);
        
        $builder->add(
            $builder->create('organizations', 'hidden')
                ->addViewTransformer(new ArrayToJsonTransformer())
        );
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName() {
        return self::NAME;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(['data_class' => $this->transport->getSettingsEntityFQCN()]);
    }
    
}
