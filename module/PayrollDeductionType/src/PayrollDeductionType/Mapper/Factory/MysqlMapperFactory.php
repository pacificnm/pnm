<?php
namespace PayrollDeductionType\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeductionType\Mapper\MysqlMapper;
use PayrollDeductionType\Hydrator\PayrollDeductionTypeHydrator;
use PayrollDeductionType\Entity\PayrollDeductionTypeEntity;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

class MysqlMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PayrollDeductionType\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new PayrollDeductionTypeHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new PayrollDeductionTypeEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}