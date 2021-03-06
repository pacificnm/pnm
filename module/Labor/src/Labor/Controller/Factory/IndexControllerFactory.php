<?php
namespace Labor\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Labor\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $laborService = $realServiceLocator->get('Labor\Service\LaborServiceInterface');
        
        return new IndexController($laborService);
        
    }
}
