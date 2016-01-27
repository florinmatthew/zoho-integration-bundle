<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\DataAuditBundle\Metadata\Annotation as Oro;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Symfony\Component\HttpFoundation\ParameterBag;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
/**
 * Class ZohoRestTransport
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 * @ORM\Entity
 * @Config()
 * @Oro\Loggable()
 */
class ZohoRestTransport extends Transport{
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="auth_api_url", type="string", length=255, nullable=false)
     */
    protected $auth_api_url;
    
    /**
     * @var string
     *
     * @ORM\Column(name="api_url", type="string", length=255, nullable=false)
     */
    protected $api_url;
    
    /**
     * @var string
     *
     * @ORM\Column(name="scope", type="string", length=255, nullable=false)
     */
    protected $scope;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email_id", type="string", length=255, nullable=false)
     */
    protected $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    protected $password;
    
    /**
     * @var string
     *
     * @ORM\Column(name="auth_token", type="string", length=255, nullable=false)
     */
    protected $auth_token;
    
    /**
     * ZohoCRM Orrganiation ID
     * @ORM\Column(name="organization_idvalue", type="integer", nullable=false)
     * @var String
     */
    protected $organization_idvalue;
    
    /**
     * @var array
     *
     * @ORM\Column(name="organizations", type="array")
     */
    protected $organizations = [];
    
    /**
     * @var ParameterBag
     */
    protected $settings;
    
    /**
     * @return ParameterBag
     */
    public function getSettingsBag(){
        $this->settings = new ParameterBag([
            'auth_token'=> $this->getAuthToken(),
            'organization_id' => $this->getOrganizationIdvalue(),
            'api_url'   => $this->getApiUrl(),
            'scope'     => $this->getScope(),
            'email'     => $this->getEmail()
        ]);
        
        return $this->settings;
    }
    
    /**
     * 
     * @param string $scope
     */
    public function setScope($scope){
        $this->scope = $scope;
        
        return $this;
    }
    
    /**
     * 
     * @param string $password
     */
    public function setPassword($password){
        $this->password = $password;
        
        return $this;
    }
    
    /**
     * 
     * @param string $password
     */
    public function getPassword(){
        return $this->password;
        
    }
    
    /**
     * 
     * @param string $email
     */
    public function setEmail($email){
        $this->email = $email;
        
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getScope(){
        return $this->scope;
    }
    
    /**
     * 
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set auth_api_url
     *
     * @param string $authApiUrl
     * @return ZohoRestTransport
     */
    public function setAuthApiUrl($authApiUrl)
    {
        $this->auth_api_url = $authApiUrl;

        return $this;
    }

    /**
     * Get auth_api_url
     *
     * @return string 
     */
    public function getAuthApiUrl()
    {
        return $this->auth_api_url;
    }

    /**
     * Set api_url
     *
     * @param string $invoiceApiUrl
     * @return ZohoRestTransport
     */
    public function setApiUrl($apiUrl)
    {
        $this->api_url = $apiUrl;

        return $this;
    }

    /**
     * Get invoice_api_url
     *
     * @return string 
     */
    public function getApiUrl()
    {
        return $this->api_url;
    }

    /**
     * Set auth_token
     *
     * @param string $authToken
     * @return ZohoRestTransport
     */
    public function setAuthToken($authToken)
    {
        $this->auth_token = $authToken;

        return $this;
    }

    /**
     * Get auth_token
     *
     * @return string 
     */
    public function getAuthToken()
    {
        return $this->auth_token;
    }

    /**
     * Set organization_idvalue
     *
     * @param integer $organizationIdvalue
     * @return ZohoRestTransport
     */
    public function setOrganizationIdvalue($organizationIdvalue)
    {
        $this->organization_idvalue = $organizationIdvalue;

        return $this;
    }
    
    /**
     * Get organization_idvalue
     *
     * @return integer 
     */
    public function getOrganizationIdvalue()
    {
        return $this->organization_idvalue;
    }

    /**
     * Set organizations
     *
     * @param array $organizations
     * @return ZohoRestTransport
     */
    public function setOrganizations($organizations)
    {
        $this->organizations = $organizations;

        return $this;
    }

    /**
     * Get organizations
     *
     * @return array 
     */
    public function getOrganizations()
    {
        return $this->organizations;
    }
}
