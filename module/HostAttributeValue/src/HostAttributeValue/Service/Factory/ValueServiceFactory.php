<?php
namespace HostAttributeValue\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostAttributeValue\Service\ValueService;

class ValueServiceFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('HostAttributeValue\Mapper\ValueMapperInterface');
        
        return new ValueService($mapper);
    }
}