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
use Employee\Controller\ViewController;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *         
 */
class ViewControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Employee\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $employeeService = $realServiceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        $workorderService = $realServiceLocator->get('WorkorderEmployee\Service\WorkorderEmployeeServiceInterface');
        
        $taskService = $realServiceLocator->get('Task\Service\TaskServiceInterface');
        
        return new ViewController($employeeService, $workorderService, $taskService);
    }
}