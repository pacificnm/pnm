<?php
namespace Payroll\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Payroll\Service\PayrollService;

class PayrollServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Payroll\Service\PayrollService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Payroll\Mapper\MysqlMapperInterface');
        
        return new PayrollService($mapper);
    }
}