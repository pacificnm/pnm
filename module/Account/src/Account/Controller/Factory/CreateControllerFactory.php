<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Account\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Account\Controller\CreateController;

/**
 *
 * @author jaimie <pacificnm@gmail.com>s
 * @version 2.5.0
 *         
 */
class CreateControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Account\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $accountService = $realServiceLocator->get('Account\Service\AccountServiceInterface');
        
        $accountForm = $realServiceLocator->get('Account\Form\AccountForm');
        
        return new CreateController($accountService, $accountForm);
    }
}