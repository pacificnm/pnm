<?php
namespace SubscriptionUser\Entity;

use User\Entity\UserEntity;
use Subscription\Entity\SubscriptionEntity;

class SubscriptionUserEntity
{

    /**
     *
     * @var number
     */
    protected $subscriptionUserId;

    /**
     *
     * @var number
     */
    protected $subscriptionId;

    /**
     *
     * @var number
     */
    protected $userId;

    /**
     *
     * @var number
     */
    protected $subscriptionUserCreate;

    /**
     *
     * @var UserEntity
     */
    protected $userEntity;

    /**
     *
     * @var SubscriptionEntity
     */
    protected $subscriptionEntity;

    /**
     *
     * @return the $subscriptionUserId
     */
    public function getSubscriptionUserId()
    {
        return $this->subscriptionUserId;
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
     * @return the $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     *
     * @return the $subscriptionUserCreate
     */
    public function getSubscriptionUserCreate()
    {
        return $this->subscriptionUserCreate;
    }

    /**
     *
     * @return the $userEntity
     */
    public function getUserEntity()
    {
        return $this->userEntity;
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
     * @param number $subscriptionUserId            
     */
    public function setSubscriptionUserId($subscriptionUserId)
    {
        $this->subscriptionUserId = $subscriptionUserId;
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
     * @param number $userId            
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     *
     * @param number $subscriptionUserCreate            
     */
    public function setSubscriptionUserCreate($subscriptionUserCreate)
    {
        $this->subscriptionUserCreate = $subscriptionUserCreate;
    }

    /**
     *
     * @param \User\Entity\UserEntity $userEntity            
     */
    public function setUserEntity($userEntity)
    {
        $this->userEntity = $userEntity;
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

