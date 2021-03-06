<?php
namespace Password\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Password\Controller\ViewController;

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
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $passwordService = $realServiceLocator->get('Password\Service\PasswordServiceInterface');
        
        $config = $realServiceLocator->get('config');
        
        return new ViewController($clientService, $passwordService, $config);
    }
}