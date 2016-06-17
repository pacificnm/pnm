<?php
namespace HostType\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostType\Service\TypeService;

class TypeServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('HostType\Mapper\TypeMapperInterface');
        
        return new TypeService($mapper);
    }
}
