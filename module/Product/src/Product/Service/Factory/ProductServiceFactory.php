<?php
namespace Product\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Product\Service\ProductService;

class ProductServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Product\Mapper\MysqlMapperInterface');
        
        return new ProductService($mapper);
    }
}