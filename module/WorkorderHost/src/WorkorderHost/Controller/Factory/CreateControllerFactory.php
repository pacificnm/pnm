<?php
namespace WorkorderHost\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderHost\Controller\CreateController;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderHost\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $workorderHostService = $realServiceLocator->get('WorkorderHost\Service\WorkorderHostServiceInterface');
        
        $workorderHostForm = $realServiceLocator->get('WorkorderHost\Form\WorkorderHostForm');
        
        return new CreateController($workorderHostService, $workorderHostForm);
    }
}

