<?php
namespace Ticket\Controller;

use Application\Controller\BaseController;
use Ticket\Service\TicketServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
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
        
        // get client
        $clientEntity = $this->getClient($clientId);
        
        // get ticket
        $ticketEntity = $this->ticketService->get($ticketId);
        
        // set sub title
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        // @todo move these two to a menu plugin called in the base controller
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'ticket-index');
        
        return new ViewModel(array(
            'ticketEntity' => $ticketEntity,
            'clientEntity' => $clientEntity,
            'clientId' => $clientId,
            'ticketId' => $ticketId
        ));
    }
}

