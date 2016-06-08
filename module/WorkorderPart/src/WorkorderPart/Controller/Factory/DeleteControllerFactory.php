<?php
namespace WorkorderPart\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderPart\Controller\DeleteController;

class DeleteControllerFactory implements FactoryInterface
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
        
        $partService = $realServiceLocator->get('WorkorderPart\Service\PartServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        return new DeleteController($clientService, $partService, $workorderService);
    }
}