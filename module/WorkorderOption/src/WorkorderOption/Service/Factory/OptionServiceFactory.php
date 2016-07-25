<?php
namespace WorkorderOption\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderOption\Service\OptionService;

class OptionServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \WorkorderOption\Service\OptionService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('WorkorderOption\Mapper\OptionMapperInterface');
        
        return new OptionService($mapper);
    }
}

