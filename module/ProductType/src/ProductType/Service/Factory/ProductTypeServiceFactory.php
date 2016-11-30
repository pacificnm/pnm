<?php
namespace ProductType\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ProductType\Service\ProductTypeService;

class ProductTypeServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \ProductType\Service\ProductTypeService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('ProductType\Mapper\MysqlMapperInterface');
        
        return new ProductTypeService($mapper);
    }
}

