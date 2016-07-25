<?php
namespace CallLogNote\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use CallLog\Service\LogServiceInterface;
use CallLogNote\Service\NoteService;
use CallLogNote\Form\NoteForm;
use Zend\View\Model\ViewModel;


class UpdateController extends BaseController
{
    protected $clientService;
    
    protected $logService;
    
    protected $noteService;
    
    protected $noteForm;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param LogServiceInterface $logService
     * @param NoteService $noteService
     * @param NoteForm $noteForm
     */
    public function __construct(ClientServiceInterface $clientService, LogServiceInterface $logService, NoteService $noteService, NoteForm $noteForm)
    {
        $this->clientService = $clientService;
    
        $this->logService = $logService;
    
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
        
        $callLogId = $this->params()->fromRoute('callLogId');
        
        $callLogNoteId = $this->params()->fromRoute('callLogNoteId');
        
        $request = $this->getRequest();
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        // validate we got a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-index');
        }
        
        $logEntity = $this->logService->get($callLogId);
        
        if(! $logEntity) {
            $this->flashMessenger()->addErrorMessage('Call log was not found');
        }
        
        $noteEntity = $this->noteService->get($callLogNoteId);
        
        if(! $noteEntity) {
            $this->flashMessenger()->addErrorMessage('Call log note was not found');
            
            return $this->redirect()->toRoute('call-log-view', array('clientId' => $id, 'callLogId' => $callLogId));
        }
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->noteForm->setData($postData);
        
            // if the form is valid
            if ($this->noteForm->isValid()) {
                $entity = $this->noteForm->getData();
        
                $noteEntity = $this->noteService->save($entity);
        
                $this->flashMessenger()->addSuccessMessage('The call log note was saved.');
        
                return $this->redirect()->toRoute('call-log-view', array('clientId' => $id, 'callLogId' => $callLogId));
            }
        }
        
        $this->noteForm->bind($noteEntity);
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Edit call Log Note');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'call-log-inxed');
        
        // return view
        return new ViewModel(array(
            'form' => $this->noteForm
        ));
    }
}

