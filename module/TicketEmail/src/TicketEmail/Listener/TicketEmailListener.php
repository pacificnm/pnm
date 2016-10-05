<?php
namespace TicketEmail\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use TicketEmail\Service\TicketEmailServiceInterface;

class TicketEmailListener implements ListenerAggregateInterface
{

    /**
     *
     * @var array
     */
    protected $listeners;

    /**
     *
     * @var TicketEmailServiceInterface
     */
    protected $ticketEmailService;

    /**
     *
     * @param TicketEmailServiceInterface $ticketEmailService            
     */
    public function __construct(TicketEmailServiceInterface $ticketEmailService)
    {
        $this->ticketEmailService = $ticketEmailService;
    }

    /**
     * 
     * @param EventInterface $event
     */
    public function ticketCreate(EventInterface $event)
    {
        $this->ticketEmailService->sendTicketCreate($event->getParam('ticketEntity'));
    }

    public function ticketUpdate(EventInterface $event)
    {
        
    }

    /**
     * 
     * @param EventInterface $event
     */
    public function ticketClose(EventInterface $event)
    {
        $this->ticketEmailService->sendTicketClose($event->getParam('ticketEntity'));
    }

    /**
     * 
     * @param EventInterface $event
     */
    public function ticketNoteCreate(EventInterface $event)
    {
        $this->ticketEmailService->sendTicketNote($event->getParam('ticketEntity'), $event->getParam('noteEntity'));
    }

    /**
     * 
     * @param EventInterface $event
     */
    public function ticketNoteUpdate(EventInterface $event)
    {
        $this->ticketEmailService->sendTicketNoteUpdate($event->getParam('ticketEntity'), $event->getParam('noteEntity'));
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
            $events->attach('ticketCreate', array(
                $this,
                'ticketCreate'
            )),
            $events->attach('ticketUpdate', array(
                $this,
                'ticketUpdate'
            )),
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