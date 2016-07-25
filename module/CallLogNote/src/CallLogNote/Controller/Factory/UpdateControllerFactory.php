<?php
namespace CallLogNote\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use CallLogNote\Controller\UpdateController;
use CallLogNote\Form\NoteForm;

class UpdateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \CallLogNote\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $logService = $realServiceLocator->get('CallLog\Service\LogServiceInterface');
        
        $noteService = $realServiceLocator->get('CallLogNote\Service\NoteServiceInterface');
        
        $noteForm = new NoteForm();
        
        return new UpdateController($clientService, $logService, $noteService, $noteForm);
    }
}

