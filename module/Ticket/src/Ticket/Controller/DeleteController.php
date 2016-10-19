<?php
namespace Ticket\Controller;

use Ticket\Service\TicketServiceInterface;
use Zend\View\Model\ViewModel;
use Client\Controller\ClientBaseController;

class DeleteController extends ClientBaseController
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
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        $ticketId = $this->params()->fromRoute('ticketId');
        
        $clientId = $this->params('clientId');
        
        // get ticket
        $ticketEntity = $this->GetTicket($clientId, $ticketId);
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            // if yes
            if ($del === 'yes') {
                $this->ticketService->delete($ticketEntity);
                
                $this->flashMessenger()->addSuccessMessage('The ticket was deleted');
                
                
                return $this->redirect()->toRoute('ticket-index', array(
                    'clientId' => $clientId
                ));
            }
            
            // no redirect to view the ticket
            return $this->redirect()->toRoute('ticket-view', array(
                'clientId' => $clientId,
                'ticketId' => $ticketId
            ));
        }
        
        // return view model
        return new ViewModel(array(
            'ticketEntity' => $ticketEntity,
            'clientEntity' => $this->clientEntity,
            'clientId' => $clientId
        ));
    }
}

