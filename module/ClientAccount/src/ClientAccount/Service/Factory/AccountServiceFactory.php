<?php
namespace ClientAccount\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ClientAccount\Service\AccountService;

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
        $mapper = $serviceLocator->get('ClientAccount\Mapper\AccountMapperInterface');
        
        return new AccountService($mapper);
    }
}
