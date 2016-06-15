<?php
namespace TaskNote\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Task\Service\TaskServiceInterface;
use TaskNote\Service\NoteServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
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
     * @var NoteServiceInterface
     */
    protected $noteService;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param TaskServiceInterface $taskService
     * @param NoteServiceInterface $noteService
     */
    public function __construct(ClientServiceInterface $clientService, TaskServiceInterface $taskService, NoteServiceInterface $noteService)
    {
        $this->clientService = $clientService;
        
        $this->taskService = $taskService;
        
        $this->noteService = $noteService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $taskId = $this->params()->fromRoute('taskId');
        
        $taskNoteId = $this->params()->fromRoute('taskNoteId');
        
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
        
        $noteEntity = $this->noteService->get($taskNoteId);
        
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
        
                $this->noteService->delete($noteEntity);
        
                $this->flashmessenger()->addSuccessMessage('The task note was deleted');
            }
        
            return $this->redirect()->toRoute('task-view', array(
                'clientId' => $id,
                'taskId' => $taskId
            ));
        }
        
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Delete Task Note');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'task-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return view
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'noteEntity' => $noteEntity
        ));
    }
}
