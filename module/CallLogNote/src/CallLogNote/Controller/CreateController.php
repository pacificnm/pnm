<?php
namespace CallLogNote\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use CallLog\Service\LogServiceInterface;
use CallLogNote\Service\NoteService;
use CallLogNote\Form\NoteForm;
use Zend\View\Model\ViewModel;

class CreateController extends BaseController
{
    protected $clientService;
    
    protected $logService;
    
    protected $noteService;
    
    protected $noteForm;
    
    public function __construct(ClientServiceInterface $clientService, LogServiceInterface $logService, NoteService $noteService, NoteForm $noteForm)
    {
        $this->clientService = $clientService;
        
        $this->logService = $logService;
        
        $this->noteService = $noteService;
        
        $this->noteForm = $noteForm;
    }
    
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $callLogId = $this->params()->fromRoute('callLogId');
        
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
        
        $this->noteForm->get('callLogNoteId')->setValue(0);
        
        $this->noteForm->get('callLogId')->setValue($callLogId);
        
        $this->noteForm->get('callLogNoteCreateBy')->setValue($this->identity()->getAuthId());
        
        $this->noteForm->get('callLogCreated')->setValue(time());
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'New call Log Note');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'call-log-inxed');
        
        // return view
        return new ViewModel(array(
            'form' => $this->noteForm
        ));
    }
}


