<?php
namespace Payroll\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Crypt\BlockCipher;
use Payroll\Controller\PrintController;

class PrintControllerFactory
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
        
        return new PrintController($service, $payrollDeductionService, $blockCipher);
    }
}