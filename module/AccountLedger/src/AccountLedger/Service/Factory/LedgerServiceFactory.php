<?php
namespace AccountLedger\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AccountLedger\Service\LedgerService;

class LedgerServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('AccountLedger\Mapper\LedgerMapperInterface');
        
        return new LedgerService($mapper);
    }
}