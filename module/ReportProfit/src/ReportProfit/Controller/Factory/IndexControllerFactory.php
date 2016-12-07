<?php
namespace ReportProfit\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ReportProfit\Controller\IndexController;

class IndexControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \ReportProfit\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('ReportProfit\Service\ReportProfitServiceInterface');
        
        return new IndexController($service);
    }
}

