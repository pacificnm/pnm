<?php
namespace Task\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Task\Controller\UpdateController;

class UpdateControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $taskService = $realServiceLocator->get('Task\Service\TaskServiceInterface');
        
        $taskForm = $realServiceLocator->get('Task\Form\TaskForm');
        
        return new UpdateController($clientService, $taskService, $taskForm);
    }
}