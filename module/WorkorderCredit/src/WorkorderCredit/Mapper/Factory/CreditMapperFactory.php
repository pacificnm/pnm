<?php
namespace WorkorderCredit\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use WorkorderCredit\Mapper\CreditMapper;
use WorkorderCredit\Hydrator\CreditHydrator;
use WorkorderCredit\Entity\CreditEntity;

class CreditMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new CreditHydrator());
        
        $prototype = new CreditEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new CreditMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}