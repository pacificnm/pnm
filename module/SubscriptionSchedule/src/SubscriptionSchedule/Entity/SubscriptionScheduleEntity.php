<?php
namespace SubscriptionSchedule\Entity;

class SubscriptionScheduleEntity
{

    /**
     *
     * @var number
     */
    protected $subscriptionScheduleId;

    /**
     *
     * @var string
     */
    protected $subscriptionScheduleName;

    /**
     *
     * @var number
     */
    protected $subscriptionScheduleStatus;

    /**
     *
     * @return the $subscriptionScheduleId
     */
    public function getSubscriptionScheduleId()
    {
        return $this->subscriptionScheduleId;
    }

    /**
     *
     * @return the $subscriptionScheduleName
     */
    public function getSubscriptionScheduleName()
    {
        return $this->subscriptionScheduleName;
    }

    /**
     *
     * @return the $subscriptionScheduleStatus
     */
    public function getSubscriptionScheduleStatus()
    {
        return $this->subscriptionScheduleStatus;
    }

    /**
     *
     * @param number $subscriptionScheduleId            
     */
    public function setSubscriptionScheduleId($subscriptionScheduleId)
    {
        $this->subscriptionScheduleId = $subscriptionScheduleId;
    }

    /**
     *
     * @param string $subscriptionScheduleName            
     */
    public function setSubscriptionScheduleName($subscriptionScheduleName)
    {
        $this->subscriptionScheduleName = $subscriptionScheduleName;
    }

    /**
     *
     * @param number $subscriptionScheduleStatus            
     */
    public function setSubscriptionScheduleStatus($subscriptionScheduleStatus)
    {
        $this->subscriptionScheduleStatus = $subscriptionScheduleStatus;
    }
}