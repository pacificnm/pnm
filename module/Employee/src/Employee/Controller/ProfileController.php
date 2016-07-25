<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Employee\Controller;

use Application\Controller\BaseController;
use Employee\Service\EmployeeServiceInterface;
use Zend\View\Model\ViewModel;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;
use Task\Service\TaskServiceInterface;
use CallLog\Service\LogServiceInterface;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class ProfileController extends BaseController
{

    /**
     *
     * @var EmployeeServiceInterface
     */
    protected $employeeService;

    /**
     * 
     * @var WorkorderEmployeeServiceInterface
     */
    protected $workorderService;
    
    /**
     * 
     * @var TaskServiceInterface
     */
    protected $taskService;
    
    protected $logService;
    
    
    public function __construct(EmployeeServiceInterface $employeeService, WorkorderEmployeeServiceInterface $workorderService, TaskServiceInterface $taskService, LogServiceInterface $logService)
    {
        $this->employeeService = $employeeService;
        
        $this->workorderService = $workorderService;
        
        $this->taskService = $taskService;
        
        $this->logService = $logService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $employeeEntity = $this->employeeService->get($this->identity()
            ->getEmployeeId());
        
        $workorderEntitys = $this->workorderService->getEmployeeWorkorders($employeeEntity->getEmployeeId());
        
        $taskEntitys = $this->taskService->getEmployeeActiveTasks($employeeEntity->getEmployeeId());
        
        $logEntitys = $this->logService->getEmployeeCallLogs($employeeEntity->getEmployeeId());
        
        // set layout up
        $this->layout()->setVariable('pageTitle', 'My Profile');
        
        $this->layout()->setVariable('pageSubTitle', $this->identity()
            ->getAuthName());
        
        $this->layout()->setVariable('activeMenuItem', 'employee');
        
        $this->layout()->setVariable('activeSubMenuItem', 'employee-profile');
        
        return new ViewModel(array(
            'employeeEntity' => $employeeEntity,
            'workorderEntitys' => $workorderEntitys,
            'taskEntitys' => $taskEntitys,
            'logEntitys' => $logEntitys
        ));
    }
}
