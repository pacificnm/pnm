<?php
namespace Ticket\Controller;

use Application\Controller\BaseController;
use Ticket\Service\TicketServiceInterface;
use Zend\View\Model\ViewModel;

class CloseController extends BaseController
{
    protected $ticketService;
    
    public function __construct(TicketServiceInterface $ticketService)
    {
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
        
        // get client
        $clientEntity = $this->getClient($clientId);
        
        // get ticket
        $ticketEntity = $this->getTicket($clientId, $ticketId);
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
                
                $ticketEntity->setTicketStatus('Closed');
        
                $this->ticketService->save($ticketEntity);
                
                // @todo complete history for ticket
                $this->SetTicketHistory($request->getUri(), 'UPDATE', $this->identity()
                    ->getAuthId(), 'Ticket was closed #', $ticketEntity->getTicketId());
        
                $this->flashMessenger()->addSuccessMessage('The ticket was closed');
               
            }
        
            return $this->redirect()->toRoute('ticket-view', array('clientId' => $clientId, 'ticketId' => $ticketId));
        }
        
        // return view model
        return new ViewModel(array(
            'clientId' => $clientId,
            'ticketId' => $ticketId,
            'clientEntity' => $clientEntity,
            'ticketEntity' => $ticketEntity
        ));
    }
}

