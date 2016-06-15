<?php
namespace TaskNote\Controller;

use Application\Controller\BaseController;
use TaskNote\Service\NoteServiceInterface;
use TaskNote\Form\NoteForm;
use Client\Service\ClientServiceInterface;

class CreateController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

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
    public function __construct(ClientServiceInterface $clientService, NoteServiceInterface $noteService, NoteForm $noteForm)
    {
        $this->clientService = $clientService;
        
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
        $clientId = $this->params()->fromRoute('clientId');
        
        $taskId = $this->params()->fromRoute('taskId');
        
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
                    'clientId' => $clientId,
                    'taskId' => $taskId
                ));
            }
        }
        
        $this->flashmessenger()->addErrorMessage('The task note was NOT saved.');
        
        return $this->redirect()->toRoute('task-view', array(
            'clientId' => $clientId,
            'taskId' => $taskId
        ));
    }
}