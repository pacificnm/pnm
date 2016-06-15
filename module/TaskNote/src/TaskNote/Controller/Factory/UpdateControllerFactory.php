<?php
namespace TaskNote\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use TaskNote\Controller\UpdateController;
use TaskNote\Form\NoteForm;

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
        
        $noteService = $realServiceLocator->get('TaskNote\Service\NoteServiceInterface');
        
        $noteForm = new NoteForm();
     
        return new UpdateController($clientService, $taskService, $noteService, $noteForm);
    }
}