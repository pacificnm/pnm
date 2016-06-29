<?php
namespace AccountType\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AccountType\Controller\ViewController;

/**
 * 
 * @author jaimie
 *
 */
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
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        return new ViewController($typeService, $accountService);
    }
}
