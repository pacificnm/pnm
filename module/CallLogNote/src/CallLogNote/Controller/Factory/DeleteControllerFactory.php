<?php
namespace CallLogNote\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use CallLogNote\Controller\DeleteController;

class DeleteControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \CallLogNote\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $logService = $realServiceLocator->get('CallLog\Service\LogServiceInterface');
        
        $noteService = $realServiceLocator->get('CallLogNote\Service\NoteServiceInterface');     
        
        return new DeleteController($clientService, $logService, $noteService);
    }
}

