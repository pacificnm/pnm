<?php
namespace TaskNote\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use TaskNote\Service\NoteServiceInterface;
use TaskNote\Form\NoteForm;
use Task\Service\TaskServiceInterface;
use Zend\View\Model\ViewModel;

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
     * @var NoteServiceInterface
     */
    protected $noteService;
    
    /**
     * 
     * @var NoteForm
     */
    protected $noteForm;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param NoteServiceInterface $noteService
     * @param NoteForm $noteForm
     */
    public function __construct(ClientServiceInterface $clientService, TaskServiceInterface $taskService, NoteServiceInterface $noteService, NoteForm $noteForm)
    {
        $this->clientService = $clientService;
        
        $this->taskService = $taskService;
        
        $this->noteService = $noteService;
        
        $this->noteForm = $noteForm;
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
        
        // if we have a post
        if ($request->isPost()) {
            $postData = $request->getPost();
        
            $this->noteForm->setData($postData);
        
            if ($this->noteForm->isValid()) {
        
                $entity = $this->noteForm->getData();
        
                $this->noteService->save($entity);
        
                $this->flashmessenger()->addSuccessMessage('The task note was saved.');
        
                return $this->redirect()->toRoute('task-view', array(
                    'clientId' => $id,
                    'taskId' => $taskId
                ));
            }
        }
        
        $noteEntity = $this->noteService->get($taskNoteId);
        
        $this->noteForm->bind($noteEntity);
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Edit Task Note');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'task-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'form' => $this->noteForm
        ));
    }
    
    
}