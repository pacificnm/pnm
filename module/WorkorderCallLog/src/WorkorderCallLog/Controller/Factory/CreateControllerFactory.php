<?php
namespace WorkorderCallLog\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCallLog\Controller\CreateController;

class CreateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \WorkorderCallLog\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $workorderCallLogService = $realServiceLocator->get('WorkorderCallLog\Service\WorkorderCallLogServiceInterface');
        
        $logService = $realServiceLocator->get('CallLog\Service\LogServiceInterface');
        
        $form = $realServiceLocator->get('WorkorderCallLog\Form\WorkorderCallLogForm');
        
        return new CreateController($workorderCallLogService, $logService, $form);
    }
}