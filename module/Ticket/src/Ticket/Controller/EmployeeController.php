<?php
namespace Ticket\Controller;

use Ticket\Service\TicketServiceInterface;
use Ticket\Form\EmployeeForm;
use Zend\View\Model\ViewModel;
use Client\Controller\ClientBaseController;

class EmployeeController extends ClientBaseController
{

    /**
     *
     * @var EmployeeForm
     */
    protected $form;

    /**
     *
     * @param TicketServiceInterface $ticketService            
     * @param EmployeeForm $form            
     */
    public function __construct(TicketServiceInterface $ticketService, EmployeeForm $form)
    {
        $this->ticketService = $ticketService;
        
        $this->form = $form;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        $ticketId = $this->params()->fromRoute('ticketId');
        
        // get ticket entity
        $ticketEntity = $this->GetTicket($this->clientId, $ticketId);
        
        // if we have a post
        if ($request->isPost()) {
            
            // get post
            $postData = $request->getPost();
            
            $this->form->setData($postData);
            
            // if we are valid
            if ($this->form->isValid()) {
                
                // save ticket
                $ticketEntity = $this->ticketService->save($this->form->getData());
                
                // trigger ticketUpdate event
                $this->getEventManager()->trigger('ticketUpdate', $this, array(
                    'ticketEntity' => $ticketEntity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                // set flash messages
                $this->flashMessenger()->addSuccessMessage('The support ticket was saved.');
                
                // return to view the ticket
                return $this->redirect()->toRoute('ticket-view', array(
                    'clientId' => $this->clientId,
                    'ticketId' => $ticketEntity->getTicketId()
                ));
            }
        }
        
        // bind to form
        $this->form->bind($ticketEntity);
              
        // return view model
        return new ViewModel(array(
            'ticketEntity' => $ticketEntity,
            'clientEntity' => $this->clientEntity,
            'clientId' => $this->clientId,
            'ticketId' => $ticketId,
            'form' => $this->form
        ));
    }
}

