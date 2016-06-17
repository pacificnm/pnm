<?php
namespace Employee\Controller;

use Application\Controller\BaseController;
use Employee\Service\EmployeeServiceInterface;
use Zend\View\Model\ViewModel;
use Task\Service\TaskServiceInterface;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;

class ViewController extends BaseController
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
    
/**
 * 
 * @param EmployeeServiceInterface $employeeService
 * @param WorkorderServiceInterface $workorderService
 * @param TaskServiceInterface $taskService
 */
    public function __construct(EmployeeServiceInterface $employeeService, WorkorderEmployeeServiceInterface $workorderService, TaskServiceInterface $taskService)
    {
        $this->employeeService = $employeeService;
        
        $this->workorderService = $workorderService;
        
        $this->taskService = $taskService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        
        
        $this->layout()->setVariable('pageTitle', 'Employee');
        
        $this->layout()->setVariable('pageSubTitle', 'View');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'employee-index');
        
        $id = $this->params()->fromRoute('employeeId');
        
        $employeeEntity = $this->employeeService->get($id);
        
        
        if(! $employeeEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the employee #' . $id);
            
            return $this->redirect()->toRoute('employee-index');
        }
        
        $workorderEntitys = $this->workorderService->getEmployeeWorkorders($employeeEntity->getEmployeeId());
        
        $taskEntitys = $this->taskService->getEmployeeActiveTasks($employeeEntity->getEmployeeId());
        
        
        
        return new ViewModel(array(
            'employeeEntity' => $employeeEntity,
            'workorderEntitys' => $workorderEntitys,
            'taskEntitys' => $taskEntitys
        ));
    }
}