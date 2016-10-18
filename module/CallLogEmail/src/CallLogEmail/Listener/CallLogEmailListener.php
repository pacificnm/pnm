<?php
namespace CallLogEmail\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use CallLogEmail\Service\CallLogEmailServiceInterface;

class CallLogEmailListener implements ListenerAggregateInterface
{
    /**
     *
     * @var array
     */
    protected $listeners;
    
    /**
     * 
     * @var CallLogEmailServiceInterface
     */
    protected $callLogEmailService;
    
    /**
     * 
     * @param CallLogEmailServiceInterface $callLogEmailService
     */
    public function __construct(CallLogEmailServiceInterface $callLogEmailService)
    {
        $this->callLogEmailService = $callLogEmailService;
    }
    
    /**
     * 
     * @param EventInterface $event
     */
    public function callLogCreate(EventInterface $event)
    {
        $this->callLogEmailService->sendCallLogEmail($event->getParam('logEntity'));
    }
    
    /**
     * 
     * @param EventInterface $event
     */
    public function callLogNoteCreate(EventInterface $event)
    {
        
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(\Zend\EventManager\EventManagerInterface $events)
    {
        $this->listeners = array(
            $events->attach('callLogCreate', array(
                $this,
                'callLogCreate'
            )),
            $events->attach('callLogNoteCreate', array(
                $this,
                'callLogNoteCreate'
            )),
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