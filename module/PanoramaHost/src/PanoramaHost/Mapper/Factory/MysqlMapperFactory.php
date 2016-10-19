<?php
namespace PanoramaHost\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PanoramaHost\Mapper\MysqlMapper;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use PanoramaHost\Hydrator\PanoramaHostHydrator;
use PanoramaHost\Entity\PanoramaHostEntity;

class MysqlMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PanoramaHost\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new PanoramaHostHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new PanoramaHostEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}