<?php
namespace Task\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Task\Service\TaskServiceInterface;
use TaskNote\Service\NoteServiceInterface;
use TaskNote\Form\NoteForm;

class ViewController extends BaseController
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
     * @param TaskServiceInterface $taskService            
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
        
        $noteEntitys = $this->noteService->getTaskNotes($taskId);
        
        // set note form
        $this->noteForm->get('taskNoteId')->setValue(0);
        
        $this->noteForm->get('taskId')->setValue($taskId);
        
        $this->noteForm->get('employeeId')->setValue($this->identity()
            ->getEmployeeId());
        
        $this->noteForm->get('taskNoteDate')->setValue(time());
        
        $this->noteForm->setAttribute('action', $this->url()
            ->fromRoute('task-note-create', array(
            'clientId' => $id,
            'taskId' => $taskId
        )));
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View Task');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'task-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'taskEntity' => $taskEntity,
            'noteEntitys' => $noteEntitys,
            'noteForm' => $this->noteForm
        ));
    }
}