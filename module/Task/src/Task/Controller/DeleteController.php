<?php
namespace Task\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Task\Service\TaskServiceInterface;
use TaskNote\Service\NoteServiceInterface;

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
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                foreach ($noteEntitys as $noteEntity) {
                    $this->noteService->delete($noteEntity);
                }
                
                $this->taskService->delete($taskEntity);
                
                $this->flashmessenger()->addSuccessMessage('The task was deleted');
                
                return $this->redirect()->toRoute('task-list', array(
                    'clientId' => $id
                ));
            }
            
            // return to view
            return $this->redirect()->toRoute('labor-view', array(
                'laborId' => $id
            ));
        }
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Delete Task');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'task-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'taskEntity' => $taskEntity
        ));
    }
}