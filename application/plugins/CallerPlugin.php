<?php

class Application_Plugin_CallerPlugin extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        if(is_null($request->getServer('HTTP_REFERER')) && is_null($request->getParam('referer'))) {
            throw new Exception('REFERER is not set!');
        }
        if(!is_null($request->getParam('referer'))) {
            $referer = $request->getParam('referer');
        } else {
            $referer = $request->getServer('HTTP_REFERER');
        }
        Zend_Registry::set('Referer', $referer);
    }

}