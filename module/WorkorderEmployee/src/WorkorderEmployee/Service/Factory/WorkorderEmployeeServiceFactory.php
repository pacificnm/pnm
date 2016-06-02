<?php
namespace WorkorderEmployee\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderEmployee\Service\WorkorderEmployeeService;

class WorkorderEmployeeServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('WorkorderEmployee\Mapper\WorkorderEmployeeMapperInterface');
        
        return new WorkorderEmployeeService($mapper);
    }
}