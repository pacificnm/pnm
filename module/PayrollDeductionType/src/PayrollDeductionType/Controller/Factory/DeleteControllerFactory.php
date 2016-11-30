<?php
namespace PayrollDeductionType\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeductionType\Controller\DeleteController;

class DeleteControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PayrollDeductionType\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface');
        
        return new DeleteController($service);
    }
}