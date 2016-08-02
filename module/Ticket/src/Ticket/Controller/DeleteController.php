<?php
namespace Ticket\Controller;

use Application\Controller\BaseController;
use Ticket\Service\TicketServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
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
        $clientId = $this->params()->fromRoute('clientId');
        
        $ticketId = $this->params()->fromRoute('ticketId');
        
        $request = $this->getRequest();
        
        // get client
        $clientEntity = $this->getClient($clientId);
        
        $ticketEntity = $this->ticketService->get($ticketId);
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                $this->ticketService->delete($ticketEntity);
                
                // @todo complete history for ticket
                $this->SetTicketHistory($request->getUri(), 'DELETE', $this->identity()
                    ->getAuthId(), 'Ticket was deleted', $ticketEntity->getTicketId());
                
                $this->flashMessenger()->addSuccessMessage('The ticket was deleted');
                
                return $this->redirect()->toRoute('ticket-index', array('clientId' => $clientId));
            }
            
            return $this->redirect()->toRoute('ticket-view', array('clientId' => $clientId, 'ticketId' => $ticketId));
        }
        
        // set layout up
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'ticket-index');
        
        return new ViewModel(array(
            'ticketEntity' => $ticketEntity,
            'clientEntity' => $clientEntity,
            'clientId' => $clientId
        ));
    }
}

