<?php
namespace PanoramaClient\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PanoramaClient\Mapper\MysqlMapper;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use PanoramaClient\Hydrator\PanoramaClientHydrator;
use PanoramaClient\Entity\PanoramaClientEntity;

class MysqlMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PanoramaClient\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new PanoramaClientHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new PanoramaClientEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}