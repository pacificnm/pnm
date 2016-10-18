<?php
namespace Ticket\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Ticket\Service\TicketServiceInterface;

class TicketListener implements ListenerAggregateInterface
{

    protected $listeners = array();

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
     * @param EventInterface $event            
     * @return \Ticket\Listener\TicketListener
     */
    public function ticketCreate(EventInterface $event)
    {
        return $this;
    }

    /**
     *
     * @param EventInterface $event            
     */
    public function workorderCreate(EventInterface $event)
    {
        $ticketId = $event->getParam('ticketId');
        
        if ($ticketId) {
            $entity = $this->ticketService->get($ticketId);
            
            $entity->setTicketStatus('Closed');
            
            $this->ticketService->save($entity);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(\Zend\EventManager\EventManagerInterface $events)
    {
        // create listener
        $this->listeners[] = $events->attach('ticketCreate', array(
            $this,
            'ticketCreate'
        ));
        
        // create work order
        $this->listeners = array(
            $events->attach('workorderCreate', array(
                $this,
                'workorderCreate'
            ))
        );
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
