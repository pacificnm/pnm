<?php
namespace EstimateOptionItem\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use EstimateOptionItem\Service\ItemService;

class ItemServiceFactory
{

    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('EstimateOptionItem\Mapper\ItemMapperInterface');
        
        return new ItemService($mapper);
    }
}