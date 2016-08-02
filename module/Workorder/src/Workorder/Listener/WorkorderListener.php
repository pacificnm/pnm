<?php
namespace Workorder\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use History\Service\HistoryServiceInterface;
use WorkorderHistory\Service\WorkorderHistoryServiceInterface;

class WorkorderListener implements ListenerAggregateInterface
{

    protected $listeners = array();
    
    /**
     *
     * @var HistoryServiceInterface
     */
    protected $historyService;
    
    /**
     *
     * @var WorkorderHistoryServiceInterface
     */
    protected $workorderHistoryService;
    

    public function __construct(HistoryServiceInterface $historyService, WorkorderHistoryServiceInterface $workorderHistoryService)
    {
        $this->historyService = $historyService;
        
        $this->workorderHistoryService = $workorderHistoryService;
    }

    public function create(EventInterface $event)
    {
        // save history
        
        // send employee email
        
        // send client email
    }
    
    public function update(EventInterface $event)
    {}
    
    public function complete(EventInterface $event)
    {}
    
    public function delete(EventInterface $event)
    {}
    
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

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('create', array(
            $this,
            'create'
        ));
        $this->listeners[] = $events->attach('update', array(
            $this,
            'update'
        ));
        $this->listeners[] = $events->attach('complete', array(
            $this,
            'complete'
        ));
        
        $this->listeners[] = $events->attach('delete', array(
            $this,
            'delete'
        ));
    }

    
}

