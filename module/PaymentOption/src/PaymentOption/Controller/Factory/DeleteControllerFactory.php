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
use PaymentOption\Controller\DeleteController;

class DeleteControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PaymentOption\Controller\DeleteController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $optionService = $realServiceLocator->get('PaymentOption\Service\OptionServiceInterface');
        
        return new DeleteController($optionService);
    }
}