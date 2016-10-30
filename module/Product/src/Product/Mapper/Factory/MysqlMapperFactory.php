<?php
namespace Product\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Product\Mapper\MysqlMapper;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Product\Hydrator\ProductHydrator;
use Product\Entity\ProductEntity;

class MysqlMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Product\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new ProductHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new ProductEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}