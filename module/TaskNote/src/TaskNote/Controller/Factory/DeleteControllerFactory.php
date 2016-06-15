<?php
namespace TaskNote\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use TaskNote\Controller\DeleteController;

class DeleteControllerFactory implements FactoryInterface
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
        
        $noteService = $realServiceLocator->get('TaskNote\Service\NoteServiceInterface');
        
        return new DeleteController($clientService, $taskService, $noteService);
    }
}