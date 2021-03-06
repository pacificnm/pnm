<?php
namespace ClientFile\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ClientFile\Controller\ViewController;

class ViewControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \ClientFile\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $clientFileService = $realServiceLocator->get('ClientFile\Service\ClientFileServiceInterface');
        
        return new ViewController($clientService, $clientFileService);
    }
}