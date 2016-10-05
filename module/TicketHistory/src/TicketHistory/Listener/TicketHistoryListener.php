<?php
namespace TicketHistory\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use TicketHistory\Service\TicketHistoryServiceInterface;

class TicketHistoryListener implements ListenerAggregateInterface
{

    /**
     * 
     * @var array
     */
    protected $listeners;

    /**
     *
     * @var TicketHistoryServiceInterface
     */
    protected $ticketHistoryService;

    /**
     *
     * @param TicketHistoryServiceInterface $ticketHistoryService            
     */
    public function __construct(TicketHistoryServiceInterface $ticketHistoryService)
    {
        $this->ticketHistoryService = $ticketHistoryService;
    }

    /**
     * 
     * @param EventInterface $event
     * @return \TicketHistory\Listener\TicketHistoryListener
     */
    public function ticketView(EventInterface $event)
    {
        $ticketEntity = $event->getParam('ticketEntity');
        
        $ticketId = $ticketEntity->getTicketId();
        
        $authId = $event->getParam('authId');
        
        $historyUrl = $event->getParam('historyUrl');
        
        $historyAction = "READ";
        
        $historyNote = "Ticket #{$ticketId} was viewed.";
        
        $this->ticketHistoryService->create($ticketId, $authId, $historyUrl, $historyAction, $historyNote);
        
        return $this;
    }
    
    /**
     *
     * @param EventInterface $event            
     * @return \TicketHistory\Listener\TicketHistoryListener
     */
    public function ticketCreate(EventInterface $event)
    {
        $ticketEntity = $event->getParam('ticketEntity');
        
        $ticketId = $ticketEntity->getTicketId();
        
        $authId = $event->getParam('authId');
        
        $historyUrl = $event->getParam('historyUrl');
        
        $historyAction = "CREATE";
        
        $historyNote = "Ticket #{$ticketId} was created.";
        
        $this->ticketHistoryService->create($ticketId, $authId, $historyUrl, $historyAction, $historyNote);
        
        return $this;
    }

    /**
     * 
     * @param EventInterface $event
     * @return \TicketHistory\Listener\TicketHistoryListener
     */
    public function ticketUpdate(EventInterface $event)
    {
        $ticketEntity = $event->getParam('ticketEntity');
        
        $ticketId = $ticketEntity->getTicketId();
        
        $authId = $event->getParam('authId');
        
        $historyUrl = $event->getParam('historyUrl');
        
        $historyAction = "UPDATE";
        
        $historyNote = "Ticket #{$ticketId} was updated.";
        
        $this->ticketHistoryService->create($ticketId, $authId, $historyUrl, $historyAction, $historyNote);
        
        return $this;
    }

    /**
     * 
     * @param EventInterface $event
     * @return \TicketHistory\Listener\TicketHistoryListener
     */
    public function ticketClose(EventInterface $event)
    {
        $ticketEntity = $event->getParam('ticketEntity');
        
        $ticketId = $ticketEntity->getTicketId();
        
        $authId = $event->getParam('authId');
        
        $historyUrl = $event->getParam('historyUrl');
        
        $historyAction = "UPDATE";
        
        $historyNote = "Ticket #{$ticketId} was closed.";
        
        $this->ticketHistoryService->create($ticketId, $authId, $historyUrl, $historyAction, $historyNote);
        
        return $this;
    }
    
    /**
     * 
     * @param EventInterface $event
     * @return \TicketHistory\Listener\TicketHistoryListener
     */
    public function ticketNoteCreate(EventInterface $event)
    {
        $ticketEntity = $event->getParam('ticketEntity');
        
        $ticketId = $ticketEntity->getTicketId();
        
        $authId = $event->getParam('authId');
        
        $historyUrl = $event->getParam('historyUrl');
        
        $historyAction = "CREATE";
        
        $historyNote = "New note was added to ticket #{$ticketId}.";
        
        $this->ticketHistoryService->create($ticketId, $authId, $historyUrl, $historyAction, $historyNote);
        
        return $this;
    }
    
    /**
     * 
     * @param EventInterface $event
     * @return \TicketHistory\Listener\TicketHistoryListener
     */
    public function ticketNoteUpdate(EventInterface $event)
    {
        $ticketEntity = $event->getParam('ticketEntity');
        
        $ticketId = $ticketEntity->getTicketId();
        
        $authId = $event->getParam('authId');
        
        $historyUrl = $event->getParam('historyUrl');
        
        $historyAction = "UPDATE";
        
        $historyNote = "The note was updated for ticket #{$ticketId}.";
        
        $this->ticketHistoryService->create($ticketId, $authId, $historyUrl, $historyAction, $historyNote);
        
        return $this;
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(\Zend\EventManager\EventManagerInterface $events)
    {
        $this->listeners = array(
            // view
            $events->attach('ticketView', array(
                $this,
                'ticketView'
            )),
            // create
            $events->attach('ticketCreate', array(
                $this,
                'ticketCreate'
            )),
            // update
            $events->attach('ticketUpdate', array(
                $this,
                'ticketUpdate'
            )),
            // close
            $events->attach('ticketClose', array(
                $this,
                'ticketClose'
            )),
            $events->attach('ticketNoteCreate', array(
                $this,
                'ticketNoteCreate'
            )),
            $events->attach('ticketNoteUpdate', array(
                $this,
                'ticketNoteUpdate'
            ))
        );
        
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\EventManager\ListenerAggregateInterface::detach()
     */
    public function detach(\Zend\EventManager\EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
        
        return $this;
    }
}