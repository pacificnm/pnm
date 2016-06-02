<?php
namespace Phone\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Phone\Mapper\PhoneMapper;
use Phone\Hydrator\PhoneHydrator;
use Phone\Entity\PhoneEntity;

class PhoneMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new PhoneHydrator());
        
        $prototype = new PhoneEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new PhoneMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}