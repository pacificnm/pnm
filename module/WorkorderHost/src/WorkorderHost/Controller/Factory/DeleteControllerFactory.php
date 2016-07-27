<?php
namespace WorkorderHost\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderHost\Controller\DeleteController;

class DeleteControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderHost\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $workorderHostService = $realServiceLocator->get('WorkorderHost\Service\WorkorderHostServiceInterface');
        
        return new DeleteController($workorderHostService);
    }
}

