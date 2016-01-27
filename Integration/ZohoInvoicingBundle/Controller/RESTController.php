<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAuthUrl;
use Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAuthParams;
use Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidAPIUrl;
use Integration\ZohoInvoicingBundle\Provider\Transport\Exceptions\InvalidToken;
use Integration\ZohoInvoicingBundle\Provider\Transport\ZohoCRMTokenRequest as APIService;

/**
 * Description of RESTController
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class RESTController extends Controller{
    
    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/ping", name="orocrm_zoho_rest_check")
     * 
     */
    public function pingAction(Request $request) {
        // https://accounts.zoho.com/apiauthtoken/nb/create
        $_params = $this->getRequest()->request->all();
        $check = new APIService();
        
        try {
            $check->setAuthUrl($_params['oro_integration_channel_form']['transport']['auth_api_url'])
                    ->setAuthParams([
                        'SCOPE'     => $_params['oro_integration_channel_form']['transport']['scope'],
                        'EMAIL_ID'  => $_params['oro_integration_channel_form']['transport']['email'],
                        'PASSWORD'  => $_params['oro_integration_channel_form']['transport']['password'],
                    ]);
                    
            $response = $check->requestToken();
        } 
        catch(InvalidAuthUrl $auth_url){
            return new JsonResponse([
                'success'   => false,
                'error_type'      => 'params',
                'which'  => 'auth_url' 
            ]);
        }
        catch(InvalidAuthParams $auth_params){
            return new JsonResponse([
                'success'   => false,
                'error_type'      => 'params',
                'which'  => 'auth_params' 
            ]);
        }
        catch (Exception $exc) {
            return new JsonResponse([
                'success'   => false,
                'error_type'=> 'unknown',
                'response'  => $exc->getMessage(),
            ]);
        }
        
        return new JsonResponse([
            'success' => true,
            'response' => $response
        ]);
    }
    
    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/organizations", name="orocrm_zoho_organizations")
     * 
     */
    
    public function organizationsAction(Request $request){
        $_params = $this->getRequest()->request->all();
        $check = new APIService();
        $check->setApiUrl($_params['apiUrl']);
        
        try {
            $response = $check->pingApiUrl($_params['apiUrl'], $_params['authToken']);
        }
        catch(InvalidToken $e){
            return new JsonResponse([
                'success'   => false,
                'error_type'=> 'params',
                'which'     => 'token',
                'response'  => $e->getMessage(),
                'token_raw' => $check->getTokenValue()
            ]);
        }
        catch(InvalidAPIUrl $e){
            return new JsonResponse([
                'success'   => false,
                'error_type'=> 'params',
                'which'     => 'api_url',
                'response'  => $e->getMessage(),
            ]);
        }
        catch (Exception $exc) {
            return new JsonResponse([
                'success'   => false,
                'error_type'=> 'unknown',
                'response'  => $exc->getMessage(),
            ]);
        }
        
        return new JsonResponse([
            'success' => true,
            'response' => $response
        ]);
    }
    
}
