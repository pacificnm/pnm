<?php
namespace CallLog\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;

class CallLogListener implements ListenerAggregateInterface
{
   
    public function __construct()
    {
    
    }
    
    public function callLogCreate(EventInterface $event)
    {
        print "called callLogCreate<br />";
        
    }
    
    public function callLogUpdate(EventInterface $event)
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
            $events->attach('callLogUpdate', array(
                $this,
                'callLogUpdate'
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

?>