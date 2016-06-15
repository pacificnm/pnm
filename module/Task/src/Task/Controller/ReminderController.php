<?php
namespace Task\Controller;

use Application\Controller\BaseController;
use Task\Service\TaskServiceInterface;
use Zend\View\Model\JsonModel;

class ReminderController extends BaseController
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
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $taskEntitys = $this->taskService->getEmployeeReminders($this->identity()->getEmployeeId());
        
        return new JsonModel(array(
            'taskEntitys' => $taskEntitys->toArray()
        ));
    }
}