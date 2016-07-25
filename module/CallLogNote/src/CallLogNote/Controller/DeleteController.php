<?php
namespace CallLogNote\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use CallLog\Service\LogServiceInterface;
use CallLogNote\Service\NoteService;
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
     * @var LogServiceInterface
     */
    protected $logService;
    
    /**
     * 
     * @var NoteService
     */
    protected $noteService;
    
    
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param LogServiceInterface $logService
     * @param NoteService $noteService
     * @param NoteForm $noteForm
     */
    public function __construct(ClientServiceInterface $clientService, LogServiceInterface $logService, NoteService $noteService)
    {
        $this->clientService = $clientService;
    
        $this->logService = $logService;
    
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
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Delete call Log Note');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'call-log-inxed');
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
        
                $this->noteService->delete($noteEntity);
        
                $this->flashmessenger()->addSuccessMessage('The call log note was deleted');
            }
        
            return $this->redirect()->toRoute('call-log-view', array(
                'clientId' => $id,
                'callLogId' => $callLogId
            ));
        }
        
        return new ViewModel(array(
            'noteEntity' => $noteEntity
        ));
    }
}

