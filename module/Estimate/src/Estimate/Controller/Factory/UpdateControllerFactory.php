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
use Estimate\Controller\UpdateController;
use Estimate\Form\EstimateForm;

class UpdateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Estimate\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $estimateService = $realServiceLocator->get('Estimate\Service\EstimateServiceInterface');
        
        $entityForm = new EstimateForm();
        
        return new UpdateController($clientService, $estimateService, $entityForm);
    }
}
