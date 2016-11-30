<?php
namespace PayrollDeduction\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeduction\Mapper\MysqlMapper;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use PayrollDeduction\Hydrator\PayrollDeductionHydrator;
use PayrollDeduction\Entity\PayrollDeductionEntity;

class MysqlMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \PayrollDeduction\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new PayrollDeductionHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new PayrollDeductionEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}

