<?php
namespace SubscriptionHost\Entity;

use Host\Entity\HostEntity;
use Subscription\Entity\SubscriptionEntity;

class SubscriptionHostEntity
{

    /**
     *
     * @var number
     */
    protected $subscriptionHostId;

    /**
     *
     * @var number
     */
    protected $hostId;

    /**
     *
     * @var number
     */
    protected $subscriptionId;

    /**
     *
     * @var number
     */
    protected $subscriptionHostCreated;

    /**
     *
     * @var HostEntity
     */
    protected $hostEntity;

    /**
     *
     * @var SubscriptionEntity
     */
    protected $subscriptionEntity;

    /**
     *
     * @return the $subscriptionHostId
     */
    public function getSubscriptionHostId()
    {
        return $this->subscriptionHostId;
    }

    /**
     *
     * @return the $hostId
     */
    public function getHostId()
    {
        return $this->hostId;
    }

    /**
     *
     * @return the $subscriptionId
     */
    public function getSubscriptionId()
    {
        return $this->subscriptionId;
    }

    /**
     *
     * @return the $subscriptionHostCreated
     */
    public function getSubscriptionHostCreated()
    {
        return $this->subscriptionHostCreated;
    }

    /**
     *
     * @return the $hostEntity
     */
    public function getHostEntity()
    {
        return $this->hostEntity;
    }

    /**
     *
     * @return the $subscriptionEntity
     */
    public function getSubscriptionEntity()
    {
        return $this->subscriptionEntity;
    }

    /**
     *
     * @param number $subscriptionHostId            
     */
    public function setSubscriptionHostId($subscriptionHostId)
    {
        $this->subscriptionHostId = $subscriptionHostId;
    }

    /**
     *
     * @param number $hostId            
     */
    public function setHostId($hostId)
    {
        $this->hostId = $hostId;
    }

    /**
     *
     * @param number $subscriptionId            
     */
    public function setSubscriptionId($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
    }

    /**
     *
     * @param number $subscriptionHostCreated            
     */
    public function setSubscriptionHostCreated($subscriptionHostCreated)
    {
        $this->subscriptionHostCreated = $subscriptionHostCreated;
    }

    /**
     *
     * @param \Host\Entity\HostEntity $hostEntity            
     */
    public function setHostEntity($hostEntity)
    {
        $this->hostEntity = $hostEntity;
    }

    /**
     *
     * @param \Subscription\Entity\SubscriptionEntity $subscriptionEntity            
     */
    public function setSubscriptionEntity($subscriptionEntity)
    {
        $this->subscriptionEntity = $subscriptionEntity;
    }
}