<?php
namespace ReportProfit\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ReportProfit\Mapper\MysqlMapper;
use ReportProfit\Hydrator\ReportProfitHydrator;
use ReportProfit\Entity\ReportProfitEntity;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

class MysqlMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \ReportProfit\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new ReportProfitHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new ReportProfitEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

