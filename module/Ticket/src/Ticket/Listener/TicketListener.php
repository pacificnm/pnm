<?php
namespace Ticket\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;

class TicketListener implements ListenerAggregateInterface
{
    protected $listeners = array();
    
    
    
    public function __construct()
    {
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
     * {@inheritDoc}
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(\Zend\EventManager\EventManagerInterface $events)
    {
        // create listener
        $this->listeners[] = $events->attach('ticketCreate', array(
            $this,
            'ticketCreate'
        ));  
    }

    /**
     * {@inheritDoc}
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
