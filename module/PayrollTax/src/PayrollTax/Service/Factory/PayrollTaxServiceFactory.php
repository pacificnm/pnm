<?php
namespace PayrollTax\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollTax\Service\PayrollTaxService;

class PayrollTaxServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PayrollTax\Service\PayrollTaxService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('PayrollTax\Mapper\MysqlMapperInterface');
        
        return new PayrollTaxService($mapper);
    }
}

