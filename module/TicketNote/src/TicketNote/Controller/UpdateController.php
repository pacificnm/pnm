<?php
namespace TicketNote\Controller;

use TicketNote\Form\EmployeeForm;
use TicketNote\Form\UserForm;
use Zend\View\Model\ViewModel;
use TicketNote\Service\NoteServiceInterface;
use Ticket\Service\TicketServiceInterface;
use Client\Controller\ClientBaseController;

class UpdateController extends ClientBaseController
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
     * @see \Client\Controller\ClientBaseController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $request = $this->getRequest();
        
        $ticketId = $this->params()->fromRoute('ticketId');
        
        $ticketNoteId = $this->params('ticketNoteId');
        
        // get ticket entity
        $ticketEntity = $this->GetTicket($this->clientId, $ticketId);
        
        // get note entity
        $noteEntity = $this->noteService->get($ticketNoteId);
        
        if (! $noteEntity) {
            $this->flashMessenger()->addErrorMessage('Ticket Note not found');
            
            return $this->redirect()->toRoute('ticket-index', array(
                'clientId' => $this->clientId
            ));
        }
        
        // get auth type
        $authType = $this->identity()->getAuthType();
        
        // get the correct form
        if ($authType == 'Employee') {
            $form = new EmployeeForm();
        } else {
            $form = new UserForm();
        }
        
        // if we have a post
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
                
                // set message
                $this->flashMessenger()->addSuccessMessage('Your note was saved.');
                
                // trigger event
                $this->getEventManager()->trigger('ticketNoteUpdate', $this, array(
                    'ticketEntity' => $ticketEntity,
                    'authId' => $this->identity()
                        ->getAuthId(),
                    'noteEntity' => $noteEntity,
                    'historyUrl' => $this->getRequest()
                        ->getUri()
                ));
                
                // return to view
                return $this->redirect()->toRoute('ticket-view', array(
                    'clientId' => $this->clientId,
                    'ticketId' => $ticketId
                ));
            }
        }
        
        // bind form
        $form->bind($noteEntity);
        
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
