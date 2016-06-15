<?php
namespace TaskPriority\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use TaskPriority\Service\PriorityService;

class PriorityServiceFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('TaskPriority\Mapper\PriorityMapperInterface');
        
        return new PriorityService($mapper);
    }
}