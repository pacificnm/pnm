<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Config\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Config\Controller\UpdateController;
use Config\Form\ConfigForm;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *         
 */
class UpdateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Config\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $configService = $realServiceLocator->get('Config\Service\ConfigServiceInterface');
        
        $configForm = new ConfigForm();
        
        $config = $realServiceLocator->get('config');
        
        return new UpdateController($configService, $configForm, $config);
    }
}