<?php
namespace Ticket\Controller;

use Ticket\Service\TicketServiceInterface;
use Zend\View\Model\ViewModel;
use Client\Controller\ClientBaseController;

class ViewController extends ClientBaseController
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
        parent::indexAction();
        
        // ticket id from route
        $ticketId = $this->params()->fromRoute('ticketId');
        
        // get ticket
        $ticketEntity = $this->GetTicket($this->clientId, $ticketId);
        
        // trigger event
        $this->getEventManager()->trigger('ticketView', $this, array(
            'ticketEntity' => $ticketEntity,
            'authId' => $this->identity()
                ->getAuthId(),
            'historyUrl' => $this->getRequest()
                ->getUri()
        ));
        
        // return view model
        return new ViewModel(array(
            'ticketEntity' => $ticketEntity,
            'clientEntity' => $this->clientEntity,
            'clientId' => $this->clientId,
            'ticketId' => $ticketId
        ));
    }
}

