<?php
namespace WorkorderNote\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderNote\Controller\UpdateController;

class UpdateControllerFactory implements FactoryInterface
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
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $noteService = $realServiceLocator->get('WorkorderNote\Service\NoteServiceInterface');
        
        $noteForm = $realServiceLocator->get('WorkorderNote\Form\NoteForm');
        
        return new UpdateController($clientService, $workorderService, $noteService, $noteForm);
    }
}