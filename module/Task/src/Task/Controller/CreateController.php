<?php
namespace Task\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Task\Service\TaskServiceInterface;
use Task\Form\TaskForm;

class CreateController extends BaseController
{
    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;
    
    /**
     * 
     * @var TaskServiceInterface
     */
    protected $taskService;
    
    /**
     * 
     * @var TaskForm    
     */
    protected $taskForm;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param TaskServiceInterface $taskService
     * @param TaskForm $taskForm
     */
    public function __construct(ClientServiceInterface $clientService, TaskServiceInterface $taskService, TaskForm $taskForm)
    {
        $this->clientService =$clientService;
        
        $this->taskService = $taskService;
        
        $this->taskForm = $taskForm;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
    
        $clientEntity = $this->clientService->get($id);
    
        // verify we have a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
    
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
        
            $this->taskForm->setData($postData);
        
            // if we are valid
            if ($this->taskForm->isValid()) {
                $entity = $this->taskForm->getData();
                
                $entity->setTaskDateStart(strtotime($entity->getTaskDateStart()));
                
                $entity->setTaskDateEnd(strtotime($entity->getTaskDateEnd()));
                
                $seconds = $entity->getTaskDateReminder() * 60;
                
                $entity->setTaskDateReminder($entity->getTaskDateEnd() - $seconds);
                
                $entity = $this->taskService->save($entity);
                
                $this->flashmessenger()->addSuccessMessage('The task was saved.');
                
                return $this->redirect()->toRoute('task-view', array(
                    'clientId' => $id,
                    'taskId' => $entity->getTaskId()
                ));
            }
        }
        
        // set form defaults
        $this->taskForm->get('taskId')->setValue(0);
        
        $this->taskForm->get('clientId')->setValue($id);
        
        $this->taskForm->get('taskDateReminderActive')->setValue(1);
        
        // set up menu and layout
        $this->layout()->setVariable('clientId', $id);
    
        $this->layout()->setVariable('pageTitle', 'Create Task');
    
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
    
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'task-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
    
        
    
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'form' => $this->taskForm
        ));
    }
}
