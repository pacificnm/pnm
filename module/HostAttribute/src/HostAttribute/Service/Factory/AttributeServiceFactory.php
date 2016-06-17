<?php
namespace HostAttribute\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HostAttribute\Service\AttributeService;

class AttributeServiceFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper =$serviceLocator->get('HostAttribute\Mapper\AttributeMapperInterface');
        
        return new AttributeService($mapper);
    }
}