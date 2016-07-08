<?php
namespace Task\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Task\Service\TaskServiceInterface;
use Task\Form\TaskForm;

class UpdateController extends BaseController
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
     */
    public function __construct(ClientServiceInterface $clientService, TaskServiceInterface $taskService, TaskForm $taskForm)
    {
        $this->clientService = $clientService;
        
        $this->taskService = $taskService;
        
        $this->taskForm = $taskForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $taskId = $this->params()->fromRoute('taskId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $taskEntity = $this->taskService->get($taskId);
        
        if (! $taskEntity) {
            $this->flashmessenger()->addErrorMessage('Task was not found.');
            
            return $this->redirect()->toRoute('task-list', array(
                'clientId' => $id
            ));
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
                
                $this->taskService->save($entity);
                
                $this->flashmessenger()->addSuccessMessage('The task was saved.');
                
                return $this->redirect()->toRoute('task-view', array(
                    'clientId' => $id,
                    'taskId' => $taskId
                ));
            }
        }
        
        $this->taskForm->bind($taskEntity);
        
        $this->taskForm->get('taskDateStart')->setValue(date("m/d/Y h:i a", $taskEntity->getTaskDateStart()));
        
        $this->taskForm->get('taskDateEnd')->setValue(date("m/d/Y h:i a", $taskEntity->getTaskDateEnd()));
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Edit Task');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeSubMenuItem', 'task-list');
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'form' => $this->taskForm
        ));
    }
}