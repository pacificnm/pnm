<?php
namespace HostAttributeMap\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostAttributeMap\Service\MapService;

class MapServiceFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('HostAttributeMap\Mapper\MapMapperInterface');
        
        $valueService = $serviceLocator->get('HostAttributeValue\Service\ValueServiceInterface');
        
        $config = $serviceLocator->get('config');
        
        return new MapService($mapper, $valueService, $config);
    }
}