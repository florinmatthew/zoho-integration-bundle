<?php

namespace Integration\ZohoInvoicingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompaniesListType extends AbstractType
{
    const NAME = 'zoho_integration_rest_transport_organization_select';
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['tooltip' => 'Default tooltip label.']);
    }
}
