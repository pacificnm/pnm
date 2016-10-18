<?php
namespace Notification\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Notification\Service\NotificationServiceInterface;
use Notification\Entity\NotificationEntity;

class NotificationListener implements ListenerAggregateInterface
{
    /**
     * 
     * @var array
     */
    protected $listeners = array();
    
    /**
     * 
     * @var NotificationServiceInterface
     */
    protected $notificationService;
    
    /**
     * 
     * @param NotificationServiceInterface $notificationService
     */
    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    
    /**
     * 
     * @param EventInterface $event
     */
    public function callLogCreate(EventInterface $event)
    {
        $logEntity = $event->getParam('logEntity');
        
        $entity = new NotificationEntity();
        
        $entity->setEmployeeId($logEntity->getEmployeeId());
        
        $entity->setNotificationDate(time());
        
        $entity->setNotificationId(0);
        
        $entity->setNotificationStatus('Active');
        
        $entity->setNotificationText('<a href="/client/'.$logEntity->getClientId().'/call-log/view/'.$logEntity->getCallLogId().'" title="View call log">New call log from ' . $logEntity->getClientEntity()->getClientName() . '</a>');
        
        $this->notificationService->save($entity);
    }
    
    /**
     * 
     * @param EventInterface $event
     */
    public function workorderCreate(EventInterface $event)
    {
        $workorderEntity = $event->getParam('workorderEntity');
        
        $employeeEntity = $event->getParam('employeeEntity');
        
        $clientEntity = $event->getParam('clientEntity');
        
        $entity = new NotificationEntity();
        
        $entity->setEmployeeId($employeeEntity->getEmployeeId());
        
        $entity->setNotificationDate(time());
        
        $entity->setNotificationId(0);
        
        $entity->setNotificationStatus('Active');
        
        $entity->setNotificationText('<a href="/client/'.$workorderEntity->getClientId().'/work-order/'.$workorderEntity->getWorkorderId().'/view" title="View work order">New Work Order for '.$clientEntity->getClientName().' </a>');
        
        $this->notificationService->save($entity);
    }
    
    /**
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
        );
        $this->listeners = array(
            $events->attach('workorderCreate', array(
                $this,
                'workorderCreate'
            )),
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

