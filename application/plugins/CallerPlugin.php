<?php

class Application_Plugin_CallerPlugin extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        if(!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
            throw new Exception('REFERER is not set!');
        }
        Zend_Registry::set('Referer', $_SERVER['HTTP_REFERER']);
    }

}