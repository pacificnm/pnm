<?php
namespace PaymentOption\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use PaymentOption\Service\OptionService;
use PaymentOption\Mapper\OptionMapperInterface;

class OptionServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('PaymentOption\Mapper\OptionMapperInterface');
        
        $memcached = $serviceLocator->get('memcached');
        
        return new OptionService($mapper, $memcached);
    }
}