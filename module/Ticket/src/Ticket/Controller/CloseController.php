<?php
namespace Ticket\Controller;

use Ticket\Service\TicketServiceInterface;
use Zend\View\Model\ViewModel;
use Client\Controller\ClientBaseController;

class CloseController extends ClientBaseController
{

    /**
     *
     * @var TicketServiceInterface
     */
    protected $ticketService;

    /**
     *
     * @param TicketServiceInterface $ticketService            
     */
    public function __construct(TicketServiceInterface $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        
        
        $request = $this->getRequest();
        
        $ticketId = $this->params()->fromRoute('ticketId');
        
        // get ticket
        $ticketEntity = $this->GetTicket($this->clientId, $ticketId);
        
        // if post
        if ($request->isPost()) {
            
            $del = $request->getPost('delete_confirmation', 'no');
            
            // if yes delete
            if ($del === 'yes') {
                
                $ticketEntity->setTicketStatus('Closed');
                
                $ticketEntity->setTicketDateClose(time());
                
                $ticketEntity = $this->ticketService->save($ticketEntity);
                
                // trigger close event
                $this->getEventManager()->trigger('ticketClose', $this, array(
                    'ticketEntity' => $ticketEntity,
                    'authId' => $this->identity()
                        ->getAuthId(),
                    'historyUrl' => $this->getRequest()
                        ->getUri()
                ));
                
                // set flash messenger
                $this->flashMessenger()->addSuccessMessage('The ticket was closed');
            }
            
            // return to view ticket
            return $this->redirect()->toRoute('ticket-view', array(
                'clientId' => $ticketEntity->getClientId(),
                'ticketId' => $ticketEntity->getTicketId()
            ));
        }
        
        // return view model
        return new ViewModel(array(
            'clientId' => $this->clientId,
            'ticketId' => $ticketId,
            'clientEntity' => $this->clientEntity,
            'ticketEntity' => $ticketEntity
        ));
    }
}

