<?php
namespace TicketNote\View\Helper;

use Zend\View\Helper\AbstractHelper;
use TicketNote\Service\NoteServiceInterface;
use TicketNote\Form\EmployeeForm;
use TicketNote\Form\UserForm;

class TicketNoteViewHelper extends AbstractHelper
{

    /**
     *
     * @var NoteServiceInterface
     */
    protected $noteService;

    /**
     *
     * @param NoteServiceInterface $noteService            
     */
    public function __construct(NoteServiceInterface $noteService)
    {
        $this->noteService = $noteService;
    }

    /**
     *
     * @param number $ticketId            
     */
    public function __invoke($clientId, $ticketId, $ticketStatus)
    {
       
        $data = new \stdClass();
        
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $identity = $view->plugin('identity');
        
        $url = $view->plugin('url');
        
        // get the note form
        if ($identity()->getAuthType() == 'Employee') {
            $form = new EmployeeForm();
        } else {
            $form = new UserForm();
            
            $form->get('ticketNoteClientView')->setValue(1);
        }
        
        // set form action
        $form->setAttribute('action', $url('ticket-note-create', array(
            'clientId' => $clientId,
            'ticketId' => $ticketId
        )), false);
        
        // set form defaults
        $form->get('ticketNoteId')->setValue(0);
        
        $form->get('ticketId')->setValue($ticketId);
        
        $form->get('authId')->setValue($identity()->getAuthId());
        
        $form->get('ticketNoteDateCreate')->setValue(time());
        
        // notes
        $noteEntitys = $this->noteService->getTicketNotes($ticketId);
        
        $data->form = $form;
        
        $data->noteEntitys = $noteEntitys;
        
        $data->ticketStatus = $ticketStatus;
        
        return $partialHelper('partials/ticket-note.phtml', $data);
    }
}

