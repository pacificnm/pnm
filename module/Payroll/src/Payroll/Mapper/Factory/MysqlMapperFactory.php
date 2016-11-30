<?php
namespace Payroll\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Payroll\Mapper\MysqlMapper;
use Payroll\Hydrator\PayrollHydrator;
use Payroll\Entity\PayrollEntity;

class MysqlMapperFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Payroll\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new PayrollHydrator());
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        $prototype = new PayrollEntity();
        
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}