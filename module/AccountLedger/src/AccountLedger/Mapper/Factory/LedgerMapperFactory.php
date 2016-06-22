<?php
namespace AccountLedger\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use AccountLedger\Mapper\LedgerMapper;
use AccountLedger\Hydrator\LedgerHydrator;
use AccountLedger\Entity\LedgerEntity;

class LedgerMapperFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new LedgerHydrator());
        
        $prototype = new LedgerEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new LedgerMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}