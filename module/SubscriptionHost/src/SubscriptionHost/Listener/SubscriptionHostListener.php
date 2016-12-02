<?php
namespace SubscriptionHost\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Host\Service\HostServiceInterface;
use SubscriptionHost\Service\SubscriptionHostServiceInterface;
use SubscriptionHost\Entity\SubscriptionHostEntity;

class SubscriptionHostListener implements ListenerAggregateInterface
{

    /**
     *
     * @var array
     */
    protected $listeners;

    /**
     *
     * @var HostServiceInterface
     */
    protected $hostService;

    /**
     *
     * @var SubscriptionHostServiceInterface
     */
    protected $subscriptionHostService;

    /**
     *
     * @param HostServiceInterface $hostService            
     * @param SubscriptionHostServiceInterface $subscriptionHostService            
     */
    public function __construct(HostServiceInterface $hostService, SubscriptionHostServiceInterface $subscriptionHostService)
    {
        $this->hostService = $hostService;
        
        $this->subscriptionHostService = $subscriptionHostService;
    }

    /**
     *
     * @param EventInterface $event            
     */
    public function subscriptionCreate(EventInterface $event)
    {
        $subscriptionEntity = $event->getParam('subscriptionEntity');
        
        $clientId = $subscriptionEntity->getClientId();
        
        
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
            $events->attach('subscriptionCreate', array(
                $this,
                'subscriptionCreate'
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