<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Employee\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Employee\Controller\UpdateController;
use Employee\Form\EmployeeForm;
use Employee\Form\ProfileForm;
use Employee\Form\PasswordForm;

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
     * @return \Employee\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $employeeService = $realServiceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        $authService = $realServiceLocator->get('Auth\Service\AuthServiceInterface');
        
        $employeeForm = new EmployeeForm();
        
        $profileForm = new ProfileForm();
        
        $passwordForm = $realServiceLocator->get('Employee\Form\PasswordForm');
        
        return new UpdateController($employeeService, $authService, $employeeForm, $profileForm, $passwordForm);
    }
}