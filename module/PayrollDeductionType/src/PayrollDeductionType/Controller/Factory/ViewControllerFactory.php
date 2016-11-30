<?php
namespace PayrollDeductionType\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeductionType\Controller\ViewController;

class ViewControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PayrollDeductionType\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface');
        
        return new ViewController($service);
    }
}