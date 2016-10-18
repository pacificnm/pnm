<?php
namespace WorkorderEmployee\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;
use WorkorderEmployee\Entity\WorkorderEmployeeEntity;

class WorkorderEmployeeListener implements ListenerAggregateInterface
{
    /**
     * 
     * @var array
     */
    protected $listeners = array();
    
    /**
     * 
     * @var WorkorderEmployeeServiceInterface
     */
    protected $workorderEmployeeService;
    
    /**
     * 
     * @param WorkorderEmployeeServiceInterface $workorderEmployeeService
     */
    public function __construct(WorkorderEmployeeServiceInterface $workorderEmployeeService)
    {
        $this->workorderEmployeeService = $workorderEmployeeService;   
    }
    
    /**
     * 
     * @param EventInterface $event
     */
    public function workorderCreate(EventInterface $event)
    {
        $workorderEntity = $event->getParam('workorderEntity');
        
        $employeeEntity = $event->getParam('employeeEntity');
        
        $entity = new WorkorderEmployeeEntity();
        
        $entity->setEmployeeId($employeeEntity->getEmployeeId());
        
        $entity->setWorkorderId($workorderEntity->getWorkorderId());
        
        $entity->setWorkorderEmployeeId(0);
        
        $this->workorderEmployeeService->save($entity);
    }
    
    /**
     * {@inheritDoc}
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(\Zend\EventManager\EventManagerInterface $events)
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