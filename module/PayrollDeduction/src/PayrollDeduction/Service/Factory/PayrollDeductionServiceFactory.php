<?php
namespace PayrollDeduction\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeduction\Service\PayrollDeductionService;

class PayrollDeductionServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PayrollDeduction\Service\PayrollDeductionService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('PayrollDeduction\Mapper\MysqlMapperInterface');
        
        return new PayrollDeductionService($mapper);
    }
}

