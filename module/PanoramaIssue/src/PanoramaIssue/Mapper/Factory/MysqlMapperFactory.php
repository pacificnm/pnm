<?php
namespace PanoramaIssue\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PanoramaIssue\Mapper\MysqlMapper;
use PanoramaIssue\Hydrator\PanoramaIssueHydrator;
use PanoramaIssue\Entity\PanoramaIssueEntity;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

class MysqlMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PanoramaIssue\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new PanoramaIssueHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new PanoramaIssueEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}