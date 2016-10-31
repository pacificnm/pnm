<?php
namespace SubscriptionStatus\Entity;

class SubscriptionStatusEntity
{

    /**
     *
     * @var number
     */
    protected $subscriptionStatusId;

    /**
     *
     * @var string
     */
    protected $subscriptionStatusName;

    /**
     *
     * @var number
     */
    protected $subscriptionStatusStatus;

    /**
     *
     * @return the $subscriptionStatusId
     */
    public function getSubscriptionStatusId()
    {
        return $this->subscriptionStatusId;
    }

    /**
     *
     * @return the $subscriptionStatusName
     */
    public function getSubscriptionStatusName()
    {
        return $this->subscriptionStatusName;
    }

    /**
     *
     * @return the $subscriptionStatusStatus
     */
    public function getSubscriptionStatusStatus()
    {
        return $this->subscriptionStatusStatus;
    }

    /**
     *
     * @param number $subscriptionStatusId            
     */
    public function setSubscriptionStatusId($subscriptionStatusId)
    {
        $this->subscriptionStatusId = $subscriptionStatusId;
    }

    /**
     *
     * @param string $subscriptionStatusName            
     */
    public function setSubscriptionStatusName($subscriptionStatusName)
    {
        $this->subscriptionStatusName = $subscriptionStatusName;
    }

    /**
     *
     * @param number $subscriptionStatusStatus            
     */
    public function setSubscriptionStatusStatus($subscriptionStatusStatus)
    {
        $this->subscriptionStatusStatus = $subscriptionStatusStatus;
    }
}