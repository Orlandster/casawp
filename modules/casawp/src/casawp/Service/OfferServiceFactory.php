<?php
namespace casawp\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OfferServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
    	$cs = $serviceLocator->get('CasasoftCategory');
    	$ns = $serviceLocator->get('CasasoftNumval');
    	$fs = $serviceLocator->get('CasasoftFeature');
    	$messenger = $serviceLocator->get('CasasoftMessenger');
    	$us = $serviceLocator->get('CasasoftUtility');
        $ios = $serviceLocator->get('CasasoftIntegratedOffer');
        $formService = $serviceLocator->get('casawpFormService');
        $service = new OfferService($cs, $ns, $messenger, $us, $fs, $ios, $formService);
        return $service;
    }
}