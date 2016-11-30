<?php
namespace PayrollDeduction\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollDeduction\Form\PayrollDeductionForm;

class PayrollDeductionFormFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \PayrollDeduction\Form\PayrollDeductionForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $service = $serviceLocator->get('PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface');
        
        return new PayrollDeductionForm($service);
    }
}

