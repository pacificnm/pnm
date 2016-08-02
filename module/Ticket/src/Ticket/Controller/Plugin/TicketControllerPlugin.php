<?php
namespace Ticket\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Ticket\Service\TicketServiceInterface;

class TicketControllerPlugin extends AbstractPlugin
{
    protected $ticketService;
    
    /**
     *
     * @var unknown
     */
    protected $controllerPluginManager;
    
    /**
     * 
     * @param TicketServiceInterface $ticketService
     * @param unknown $controllerPluginManager
     */
    public function __construct(TicketServiceInterface $ticketService, $controllerPluginManager)
    {
        $this->ticketService = $ticketService;
        
        $this->controllerPluginManager = $controllerPluginManager;
    }
    
    /**
     * 
     * @param number $clientId
     * @param number $ticketId
     * @return \Ticket\Entity\TicketEntity
     */
    public function __invoke($clientId, $ticketId)
    {
        $ticketEntity = $this->ticketService->get($ticketId);
        
        if(! $ticketEntity) {
            $flashmessenger = $this->controllerPluginManager->get('flashMessenger');
            
            $redirect = $this->controllerPluginManager->get('redirect');
            
            $flashmessenger->addErrorMessage('Ticket was not found.');
          
            return $redirect->toRoute('ticket-index', array('clientId' => $clientId));
        }
        
        return $ticketEntity;
    }
}

