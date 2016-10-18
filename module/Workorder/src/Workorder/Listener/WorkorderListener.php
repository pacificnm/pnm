<?php
namespace Workorder\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;

class WorkorderListener implements ListenerAggregateInterface
{

    protected $listeners = array();

    public function __construct()
    {}

    public function workorderCreate(EventInterface $event)
    {}

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners = array(
            $events->attach('workorderCreate', array(
                $this,
                'workorderCreate'
            ))
        );
        
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\EventManager\ListenerAggregateInterface::detach()
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
        
        return $this;
    }
}