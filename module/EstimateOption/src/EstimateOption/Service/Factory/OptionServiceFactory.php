<?php
namespace EstimateOption\Service\Factory;

use EstimateOption\Service\OptionService;
use Zend\ServiceManager\ServiceLocatorInterface;

class OptionServiceFactory
{

    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('EstimateOption\Mapper\OptionMapperInterface');
        
        return new OptionService($mapper);
    }
}