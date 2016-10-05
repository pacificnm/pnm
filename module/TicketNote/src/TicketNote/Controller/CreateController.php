<?php
namespace TicketNote\Controller;

use TicketNote\Form\EmployeeForm;
use TicketNote\Form\UserForm;
use Zend\View\Model\ViewModel;
use TicketNote\Service\NoteServiceInterface;
use Ticket\Service\TicketServiceInterface;
use Client\Controller\ClientBaseController;

class CreateController extends ClientBaseController
{
    /**
     * 
     * @var NoteServiceInterface
     */
    protected $noteService;
    
    /**
     * 
     * @var TicketServiceInterface
     */
    protected $ticketService;
    
    /**
     * 
     * @param NoteServiceInterface $noteService
     * @param TicketServiceInterface $ticketService
     */
    public function __construct(NoteServiceInterface $noteService, TicketServiceInterface $ticketService)
    {
        $this->noteService = $noteService;
        
        $this->ticketService = $ticketService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $request = $this->getRequest();
        
        $ticketId = $this->params()->fromRoute('ticketId');

        // get ticket
        $ticketEntity = $this->GetTicket($this->clientId,$ticketId);
        
        $authType = $this->identity()->getAuthType();
        
        // get the correct form
        if($authType == 'Employee') {
            $form = new EmployeeForm();
        } else {
            $form = new UserForm();
            
            $form->get('ticketNoteClientView')->setValue(1);
        }
        
        if ($request->isPost()) {
        
            // get post
            $postData = $request->getPost();
        
            $form->setData($postData);
        
            // if we are valid
            if ($form->isValid()) {
                // get hydrated form results
                $entity = $form->getData();
             
                // save the note
                $noteEntity = $this->noteService->save($entity);
                
                // if status is not active set it
                if($ticketEntity->getTicketStatus() != 'Active') {
                    $ticketEntity->setTicketStatus('Active');
                    
                    $this->ticketService->save($ticketEntity);
                }
                
                // trigger event
                $this->getEventManager()->trigger('ticketNoteCreate', $this, array(
                    'ticketEntity' => $ticketEntity,
                    'noteEntity' => $noteEntity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                $this->flashMessenger()->addSuccessMessage('Your note was saved.');
                
                // return to view ticket
                return $this->redirect()->toRoute('ticket-view', array(
                    'clientId' => $this->clientId,
                    'ticketId' => $ticketId
                ));
            }
        }
        
        // set form defaults
        $form->get('ticketId')->setValue($ticketId);
        
        $form->get('authId')->setValue($this->identity()->getAuthId());
        
        $form->get('ticketNoteDateCreate')->setValue(time());
        
        // return view
        return new ViewModel(array(
            'clientId' => $this->clientId,
            'ticketId' => $ticketId,
            'clientEnitity' => $this->clientEntity,
            'ticketEntity' => $ticketEntity,
            'form' => $form
        ));
        
    }
}

