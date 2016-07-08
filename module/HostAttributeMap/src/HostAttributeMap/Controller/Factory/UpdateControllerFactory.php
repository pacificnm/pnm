<?php
namespace HostAttributeMap\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use HostAttributeMap\Controller\UpdateController;

class UpdateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \HostAttributeMap\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $hostService = $realServiceLocator->get('Host\Service\HostServiceInterface');
        
        $mapService = $realServiceLocator->get('HostAttributeMap\Service\MapServiceInterface');
        
        $workstationForm = $realServiceLocator->get('HostAttributeMap\Form\WorkstationForm');
        
        $serverForm = $realServiceLocator->get('HostAttributeMap\Form\ServerForm');
        
        $laptopForm = $realServiceLocator->get('HostAttributeMap\Form\LaptopForm');
        
        $valueService = $realServiceLocator->get('HostAttributeValue\Service\ValueServiceInterface');
        
        $tabletForm = $realServiceLocator->get('HostAttributeMap\Form\TabletForm');
        
        $printerForm = $realServiceLocator->get('HostAttributeMap\Form\PrinterForm');
        
        $copierForm = $realServiceLocator->get('HostAttributeMap\Form\CopierForm');
        
        $scannerForm = $realServiceLocator->get('HostAttributeMap\Form\ScannerForm');
        
        $routerForm = $realServiceLocator->get('HostAttributeMap\Form\RouterForm');
        
        $wirelessRouterForm = $realServiceLocator->get('HostAttributeMap\Form\WirelessRouterForm');
        
        $accessPointForm = $realServiceLocator->get('HostAttributeMap\Form\AccessPointForm');
        
        $otherForm = $realServiceLocator->get('HostAttributeMap\Form\OtherForm');
        
        $config = $realServiceLocator->get('config');
        
        return new UpdateController($clientService, $hostService, $mapService, $workstationForm, $serverForm, $laptopForm, $tabletForm, $printerForm, $copierForm, $scannerForm, $routerForm, $wirelessRouterForm, $accessPointForm, $otherForm, $config);
    }
}