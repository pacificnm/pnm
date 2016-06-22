<?php
namespace VendorAccount\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use VendorAccount\Service\AccountService;

class AccountServiceFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('VendorAccount\Mapper\AccountMapperInterface');
        
        return new AccountService($mapper);
    }
}