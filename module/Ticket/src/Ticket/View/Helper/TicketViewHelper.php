<?php
namespace Ticket\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Ticket\Service\TicketServiceInterface;

class TicketViewHelper extends AbstractHelper
{

    /**
     * 
     * @var unknown
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
     * @param number $clientId
     * @param string $ticketStatus
     * @param number $userId
     */
    public function __invoke($clientId = null, $ticketStatus = 'Open', $userId = null)
    {
        $data = new \stdClass();
        
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $filter = array();
        
        if($clientId) {
            $filter['clientId'] = $clientId;
        }
        
        if($ticketStatus) {
            $filter['ticketStatus'] = $ticketStatus;
        }
        
        if($userId) {
            $filter['userId'] = $userId;
        }
        
        $ticketEntitys = $this->ticketService->getAll($filter);
        
        $data->ticketEntitys = $ticketEntitys;
        
        return $partialHelper('partials/ticket.phtml', $data);
    }
}

