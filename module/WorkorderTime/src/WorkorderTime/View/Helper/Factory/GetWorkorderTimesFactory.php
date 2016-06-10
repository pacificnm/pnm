<?php
namespace WorkorderTime\View\Helper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderTime\View\Helper\GetWorkorderTimes;

class GetWorkorderTimesFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $timeService = $realServiceLocator->get('WorkorderTime\Service\TimeServiceInterface');
        
        return new GetWorkorderTimes($timeService);
    }
}