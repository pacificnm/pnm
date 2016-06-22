<?php
namespace AccountType\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AccountType\Controller\ViewController;

class ViewControllerFactory implements FactoryInterface
{
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $typeService = $realServiceLocator->get('AccountType\Service\TypeServiceInterface');
        
        return new ViewController($typeService);
    }
}
