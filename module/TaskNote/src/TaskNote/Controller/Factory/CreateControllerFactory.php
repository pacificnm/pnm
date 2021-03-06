<?php
namespace TaskNote\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use TaskNote\Controller\CreateController;
use TaskNote\Form\NoteForm;

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
        
        $noteService = $realServiceLocator->get('TaskNote\Service\NoteServiceInterface');
        
        $noteForm = new NoteForm();
        
        return new CreateController($clientService, $noteService, $noteForm);
    }
}
