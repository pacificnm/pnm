<?php
namespace Log\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Log\Service\LogService;

class LogServiceFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Log\Service\LogService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        return new LogService();
    }
}