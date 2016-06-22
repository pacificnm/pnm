<?php
namespace Account\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Account\Service\AccountService;

class AccountServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Account\Mapper\AccountMapperInterface');
        
        return new AccountService($mapper);
    }
}