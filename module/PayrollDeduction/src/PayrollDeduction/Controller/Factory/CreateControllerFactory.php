<?php
namespace PayrollDeduction\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeduction\Controller\CreateController;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \PayrollDeduction\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('PayrollDeduction\Service\PayrollDeductionServiceInterface');
        
        $payrollService = $realServiceLocator->get('Payroll\Service\PayrollServiceInterface');
        
        $form = $realServiceLocator->get('PayrollDeduction\Form\PayrollDeductionForm');
        
        return new CreateController($service, $payrollService, $form);
    }
}

