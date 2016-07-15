<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Estimate\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Estimate\Controller\PrintController;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class PrintControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Estimate\Controller\PrintController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
    
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
    
        $estimateService = $realServiceLocator->get('Estimate\Service\EstimateServiceInterface');
    
        $locationService = $realServiceLocator->get('Location\Service\LocationServiceInterface');
    
        $phoneService = $realServiceLocator->get('Phone\Service\PhoneServiceInterface');
    
        $optionService = $realServiceLocator->get('EstimateOption\Service\OptionServiceInterface');
    
        $itemService = $realServiceLocator->get('EstimateOptionItem\Service\ItemServiceInterface');
    
        return new PrintController($clientService, $estimateService, $locationService, $phoneService, $optionService, $itemService);
    }
}