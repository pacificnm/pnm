<?php
namespace Task\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Task\Service\TaskServiceInterface;

class NavBarTask extends AbstractHelper
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
     */
    public function __invoke()
    {
        $view = $this->getView();
    
        $partialHelper = $view->plugin('partial');
    
        $taksEntitys = $this->taskService->getEmployeeActiveTasks($view->Identity()->getEmployeeId());
        
        $data  = new \stdClass();
        
        $data->taksEntitys = $taksEntitys;
        
        
        return $partialHelper('partials/nav-bar-task.phtml', $data);
    }
}
