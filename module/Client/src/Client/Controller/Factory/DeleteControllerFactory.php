<?php
namespace Client\Controller\Factory;

use Client\Controller\DeleteController;
use Zend\ServiceManager\ServiceLocatorInterface;

class DeleteControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Client\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        return new DeleteController($clientService);
    }
}
