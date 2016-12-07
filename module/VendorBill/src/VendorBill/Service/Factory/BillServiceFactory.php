<?php
namespace VendorBill\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use VendorBill\Service\BillService;

class BillServiceFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \VendorBill\Service\BillService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('VendorBill\Mapper\MysqlMapperInterface');
        
        return new BillService($mapper);
    }
}