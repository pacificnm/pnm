<?php
namespace Install\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Install\Controller\DatabaseController;

class DatabaseControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $installService = $realServiceLocator->get('Install\Service\InstallServiceInterface');
        
        return new DatabaseController($installService);
    }
}
