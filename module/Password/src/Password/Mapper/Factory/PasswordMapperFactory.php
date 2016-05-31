<?php
namespace Password\Mapper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Password\Mapper\PasswordMapper;
use Password\Entity\PasswordEntity;
use Password\Hydrator\PasswordHydrator;

class PasswordMapperFactory implements FactoryInterface
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
        
        $hydrator->add(new PasswordHydrator());
        
        $prototype = new PasswordEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new PasswordMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}