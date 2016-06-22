<?php
namespace Account\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Account\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        return new IndexController($accountService);
    }
}