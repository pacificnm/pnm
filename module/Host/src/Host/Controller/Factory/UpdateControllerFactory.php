<?php
namespace Host\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Host\Controller\UpdateController;

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
        
        $hostService = $realServiceLocator->get('Host\Service\HostServiceInterface');
        
        $hostForm = $realServiceLocator->get('Host\Form\HostForm');
        
        return new UpdateController($clientService, $hostService, $hostForm);
    }
}