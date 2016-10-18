<?php
namespace WorkorderHistory\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use WorkorderHistory\Service\WorkorderHistoryServiceInterface;

class WorkorderHistoryListener implements ListenerAggregateInterface
{
    /**
     *
     * @var array
     */
    protected $listeners = array();
    
    /**
     * 
     * @var WorkorderHistoryServiceInterface
     */
    protected $workorderHistoryService;
    
    /**
     * 
     * @param WorkorderHistoryServiceInterface $workorderHistoryService
     */
    public function __construct(WorkorderHistoryServiceInterface $workorderHistoryService)
    {
        $this->workorderHistoryService = $workorderHistoryService;
    }

    /**
     * 
     * @param EventInterface $event
     */
    public function workorderCreate(EventInterface $event)
    {
        $authId = $event->getParam('authId');
        
        $historyUrl = $event->getParam('historyUrl');
        
        $workorderEntity = $event->getParam('workorderEntity');
        
        $historyAction = "READ";
        
        $historyNote = "Work Order #{$workorderEntity->getWorkorderId()} was created.";
        
        $this->workorderHistoryService->create($workorderEntity->getWorkorderId(), $authId, $historyUrl, $historyAction, $historyNote);
    }
    
    /**
     * 
     * @param EventInterface $event
     */
    public function workorderView(EventInterface $event)
    {
        $authId = $event->getParam('authId');
        
        $historyUrl = $event->getParam('historyUrl');
        
        $workorderEntity = $event->getParam('workorderEntity');
        
        $historyAction = "READ";
        
        $historyNote = "Work Order #{$workorderEntity->getWorkorderId()} was viewed.";
        
        $this->workorderHistoryService->create($workorderEntity->getWorkorderId(), $authId, $historyUrl, $historyAction, $historyNote);
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
            $events->attach('workorderCreate', array(
                $this,
                'workorderCreate'
            )),
        );
        
        $this->listeners = array(
            $events->attach('workorderView', array(
                $this,
                'workorderView'
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
