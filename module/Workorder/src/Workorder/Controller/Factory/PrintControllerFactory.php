<?php
namespace Workorder\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Workorder\Controller\PrintController;

class PrintControllerFactory implements FactoryInterface
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
        
        $timeService = $realServiceLocator->get('WorkorderTime\Service\TimeServiceInterface');
        
        $partService = $realServiceLocator->get('WorkorderPart\Service\PartServiceInterface');
        
        
        return new PrintController($clientService, $workorderService, $noteService, $timeService, $partService);
    }
}