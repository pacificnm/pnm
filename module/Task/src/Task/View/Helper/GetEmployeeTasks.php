<?php
namespace Task\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Task\Service\TaskServiceInterface;

class GetEmployeeTasks extends AbstractHelper
{
    /**
     * 
     * @var TaskServiceInterface
     */
    protected $taskService;
    
    /**
     * 
     * @param TaskServiceInterface $taskService
     */
    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }
    
    /**
     * 
     * @param unknown $employeeId
     */
    public function __invoke($employeeId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $taskEntitys = $this->taskService->getEmployeeActiveTasks($employeeId);
        
        $data->taskEntitys = $taskEntitys;

        return $partialHelper('partials/get-employee-tasks.phtml', $data);
    }
}