<?php
namespace WorkorderCallLog\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCallLog\Controller\DeleteController;

class DeleteControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderCallLog\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $workorderCallLogService = $realServiceLocator->get('WorkorderCallLog\Service\WorkorderCallLogServiceInterface');
        
        return new DeleteController($workorderCallLogService);
    }
}