<?php
namespace PayrollDeductionType\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeductionType\Service\PayrollDeductionTypeService;

class PayrollDeductionTypeServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PayrollDeductionType\Service\PayrollDeductionTypeService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('PayrollDeductionType\Mapper\MysqlMapperInterface');
        
        return new PayrollDeductionTypeService($mapper);
    }
}