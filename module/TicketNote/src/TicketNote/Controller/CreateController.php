<?php
namespace TicketNote\Controller;

use Application\Controller\BaseController;
use TicketNote\Form\EmployeeForm;
use TicketNote\Form\UserForm;
use Zend\View\Model\ViewModel;
use TicketNote\Service\NoteServiceInterface;
use Ticket\Service\TicketServiceInterface;

class CreateController extends BaseController
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
        $request = $this->getRequest();
        
        $clientId = $this->params()->fromRoute('clientId');
        
        $ticketId = $this->params()->fromRoute('ticketId');
        
        $clientEntity = $this->getClient($clientId);
        
        $ticketEntity = $this->GetTicket($clientId, $ticketId);
        
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

                // set history
                $this->SetTicketHistory($request->getUri(), 'CREATE', $this->identity()
                    ->getAuthId(), 'Note was added to ticket #', $ticketId);
                
                // if status is not active set it
                if($ticketEntity->getTicketStatus() != 'Active') {
                    $ticketEntity->setTicketStatus('Active');
                    
                    $this->ticketService->save($ticketEntity);
                }
                
                $this->flashMessenger()->addSuccessMessage('Your note was saved.');
                
                return $this->redirect()->toRoute('ticket-view', array(
                    'clientId' => $clientId,
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
            'clientId' => $clientId,
            'ticketId' => $ticketId,
            'clientEnitity' => $clientEntity,
            'ticketEntity' => $ticketEntity,
            'form' => $form
        ));
        
    }
}

