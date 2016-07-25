<?php
namespace CallLogNote\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use CallLogNote\Controller\CreateController;
use CallLogNote\Form\NoteForm;

class CreateControllerFactory
{
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $logService = $realServiceLocator->get('CallLog\Service\LogServiceInterface');
        
        $noteService = $realServiceLocator->get('CallLogNote\Service\NoteServiceInterface');
        
        $noteForm = new NoteForm();
        
        return new CreateController($clientService, $logService, $noteService, $noteForm);
    }
}

