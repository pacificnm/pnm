<?php
namespace WorkorderNote\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderNote\Controller\DeleteController;

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
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $noteService = $realServiceLocator->get('WorkorderNote\Service\NoteServiceInterface');
        
        return new DeleteController($clientService, $workorderService, $noteService);
    }
}