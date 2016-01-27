<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Provider\Transport;
use Guzzle\Http\Client as GClient;

/**
 * Description of ZohoCRMTokenRequest
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class ZohoCRMTokenRequest {
    
    /**
     *
     * @var Guzzle\Http\Client Gutza-client;
     */
    protected $client;
    
    /**
     *
     * @var string 
     */
    protected $auth_url;
    
    /**
     *
     * @var string 
     */
    protected $api_url;
    
    /**
     *
     * @var String 
     */
    protected $token = null;
    
    /**
     *
     * @var Array 
     */
    protected $params = [];
    
    private static $rq = ['SCOPE', 'EMAIL_ID', 'PASSWORD'];
    
    /**
     * Organizations API url.
     */
    protected static $organizations_url = "organizations";
    
    function __construct() {
        $this->client = new GClient();
    }
    
    /**
     * 
     * @param type $auth_url
     * @return \Integration\ZohoInvoicingBundle\Provider\Transport\ZohoCRMTokenRequest
     */
    public function setAuthUrl($auth_url){
        $this->auth_url = $auth_url;
        
        return $this;
    }
    
    /**
     * 
     * @return String
     */
    public function getAuthUrl(){
        return $this->auth_url;
    }
    
    /**
     * 
     * @param Array $auth_params
     * @return \Integration\ZohoInvoicingBundle\Provider\Transport\ZohoCRMTokenRequest
     */
    public function setAuthParams(array $auth_params){
        $this->params = $auth_params;
                
        return $this;  
    }
    
    /**
     * 
     * @return Array
     */
    public function getAuthParams(){
        return $this->params;
    }
    
    /**
     * 
     * @param type $apiUrl
     * @return \Integration\ZohoInvoicingBundle\Provider\Transport\ZohoCRMTokenRequest
     */
    public function setApiUrl($apiUrl){
        $this->api_url = $apiUrl;
        
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getApiUrl(){
        return $this->api_url;
    }
    
    public function getTokenValue(){
        return $this->token;
    }

    /**
     * 
     * @return type
     * @throws \Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAuthUrl
     * @throws \Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAuthParams
     * @throws \Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAPIUrl
     */
    public function requestToken(){
        
        $companies = null;
        
        if(! isset($this->auth_url) || $this->auth_url == ""){
            throw new \Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAuthUrl();
        }
        
        if(! isset($this->params) || $this->params == ""){
            throw new \Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAuthParams();
        }else{
            foreach (self::$rq as $key){
                if(! array_key_exists($key, $this->params)){
                    throw new \Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAuthParams();
                }
            }
            
            foreach ($this->params as $param){
                if($param === "") throw new \Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAuthParams();
            }
        }
        
        $request = $this->client->post($this->auth_url, null, $this->params, []);
        $response = $request->send();
        $parsed_response = $this->parseResponseBody($response->getBody(true));
        
//        if("" !== $parsed_response['token']){
//            $this->token = $parsed_response['token'];
//        }
        
        return 
            ['code' => $response->getStatusCode(),'body' => $parsed_response];
        
    }
    
    /**
     * 
     * @param type $api_url
     * @param type $auth_token
     * @return type
     * @throws \Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAPIUrl
     * @throws \Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidToken
     */
    public function pingApiUrl($api_url, $auth_token){
        // - https://invoice.zoho.com/api/v3/
        if($api_url == ""){
            throw new \Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAPIUrl();
        }
        
        if($auth_token == ""){
            throw new \Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidToken();
        }
        
        $org_url = $api_url . static::$organizations_url . "?authtoken=" . $auth_token;
        
        $request = $this->client->get($org_url, null, []);
        $response = $request->send();
        
        return
            ['code' => $response->getStatusCode(), 'body' => json_decode($response->getBody(true))];
        
    }
    
    /**
     * 
     * @param type $response
     */
    private function parseResponseBody($response){
        $lines = explode("\n", $response);
        $result = ""; $token = ""; $cause = "";
        
        foreach ($lines as $key=>$line){
            if(FALSE !== strpos($line, "#") || $line === ""){
                unset($lines[$key]);
            }
        }
        
        $lines = array_values($lines);
        
        foreach ($lines as $line){
            if(FALSE !== strpos($line, "AUTHTOKEN=")){
                $token = str_replace("AUTHTOKEN=", "", $line);
                $this->token = $token;
            }
            
            if(FALSE !== strpos($line, "RESULT=")){
                $result = str_replace("RESULT=", "", $line);
            }
            
            if(FALSE !== strpos($line, "CAUSE=")){
                $cause = str_replace("CAUSE=", "", $line);
            }
        }
        
        return ['result' => $result, 'cause' => $cause,'token' => $token];
    }
    
}
