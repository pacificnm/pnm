<?php
namespace VendorAccount\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use VendorAccount\Mapper\AccountMapper;
use VendorAccount\Hydrator\AccountHydrator;
use VendorAccount\Entity\AccountEntity;

class AccountMapperFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new AccountHydrator());
        
        $prototype = new AccountEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new AccountMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}