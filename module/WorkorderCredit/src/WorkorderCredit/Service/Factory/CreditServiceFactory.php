<?php
namespace WorkorderCredit\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderCredit\Service\CreditService;

class CreditServiceFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('WorkorderCredit\Mapper\CreditMapperInterface');
        
        return new CreditService($mapper);
    }
}