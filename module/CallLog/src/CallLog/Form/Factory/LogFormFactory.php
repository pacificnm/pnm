<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace CallLog\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use CallLog\Form\LogForm;

class LogFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \CallLog\Form\LogForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $employeeService = $serviceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        return new LogForm($employeeService);
    }
}