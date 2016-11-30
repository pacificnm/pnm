<?php
namespace Payroll\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Payroll\Controller\ViewController;
use Zend\Crypt\BlockCipher;

class ViewControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Payroll\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Payroll\Service\PayrollServiceInterface');
        
        $payrollDeductionService = $realServiceLocator->get('PayrollDeduction\Service\PayrollDeductionServiceInterface');
        
        $config = $realServiceLocator->get('config');
        
        // encrypt ssi number
        $blockCipher = BlockCipher::factory('mcrypt', array(
            'algo' => 'aes'
        ));
        
        $blockCipher->setKey($config['encryption-key']);
        
        $form = $realServiceLocator->get('PayrollDeduction\Form\PayrollDeductionForm');
        
        return new ViewController($service, $payrollDeductionService, $blockCipher, $form);
    }
}