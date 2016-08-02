<?php
namespace Ticket\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class TicketHistoryPlugin extends AbstractPlugin
{
    protected $historyService;
    
    public function __construct()
    {
        
    }
    
    public function __invoke($uri, $action, $authId, $note, $ticketId)
    {
        
    }
}


