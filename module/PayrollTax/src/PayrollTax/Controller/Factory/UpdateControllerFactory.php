<?php
namespace PayrollTax\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PayrollTax\Controller\UpdateController;
use PayrollTax\Form\PayrollTaxForm;

class UpdateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \PayrollTax\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('PayrollTax\Service\PayrollTaxServiceInterface');
        
        $form = new PayrollTaxForm();
        
        return new UpdateController($service, $form);
    }
}

