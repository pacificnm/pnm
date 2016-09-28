<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace PaymentOption\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PaymentOption\Controller\UpdateController;
use PaymentOption\Form\OptionForm;

class UpdateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PaymentOption\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $optionService = $realServiceLocator->get('PaymentOption\Service\OptionServiceInterface');
        
        $optionForm = new OptionForm('payment-option-form', array());
        
        return new UpdateController($optionService, $optionForm);
    }
}