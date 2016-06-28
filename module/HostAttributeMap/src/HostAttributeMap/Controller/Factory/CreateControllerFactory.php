<?php
namespace HostAttributeMap\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostAttributeMap\Controller\CreateController;
use HostAttributeMap\Form\TabletForm;

class CreateControllerFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
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
        
        $config = $realServiceLocator->get('config');
        
        return new CreateController($clientService, $hostService, $mapService, $workstationForm, $serverForm, $laptopForm, $tabletForm, $printerForm, $copierForm, $scannerForm, $routerForm, $config);
    }
}
