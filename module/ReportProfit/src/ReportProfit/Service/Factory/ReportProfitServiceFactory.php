<?php
namespace ReportProfit\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ReportProfit\Service\ReportProfitService;

class ReportProfitServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \ReportProfit\Service\ReportProfitService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('ReportProfit\Mapper\MysqlMapperInterface');
        
        return new ReportProfitService($mapper);
    }
}

