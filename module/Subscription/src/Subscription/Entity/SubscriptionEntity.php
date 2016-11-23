<?php
namespace Subscription\Entity;

use Product\Entity\ProductEntity;
use SubscriptionSchedule\Entity\SubscriptionScheduleEntity;
use SubscriptionStatus\Entity\SubscriptionStatusEntity;
use PaymentOption\Entity\OptionEntity;

class SubscriptionEntity
{

    /**
     *
     * @var number
     */
    protected $subscriptionId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $subscriptionDateCreate;

    /**
     *
     * @var number
     */
    protected $subscriptionDateDue;

    /**
     *
     * @var number
     */
    protected $subscriptionDateUpdate;

    /**
     *
     * @var number
     */
    protected $subscriptionDateEnd;

    /**
     *
     * @var number
     */
    protected $paymentOptionId;

    /**
     *
     * @var number
     */
    protected $subscriptionScheduleId;

    /**
     *
     * @var number
     */
    protected $subscriptionStatusId;

    /**
     *
     * @var number
     */
    protected $productId;

    /**
     *
     * @var number
     */
    protected $nextProductId;

    /**
     * 
     * @var bool
     */
    protected $subscriptionHost;
    
    /**
     * 
     * @var bool
     */
    protected $subscriptionUser;
    
    /**
     *
     * @var ProductEntity
     */
    protected $productEntity;

    /**
     *
     * @var ProductEntity
     */
    protected $nextProductEntity;

    /**
     *
     * @var SubscriptionStatusEntity
     */
    protected $subscriptionStatusEntity;

    /**
     *
     * @var SubscriptionScheduleEntity
     */
    protected $subscriptionScheduleEntity;

    /**
     *
     * @var OptionEntity
     */
    protected $paymentOptionEntity;
    /**
     * @return the $subscriptionId
     */
    public function getSubscriptionId()
    {
        return $this->subscriptionId;
    }

    /**
     * @return the $clientId
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return the $subscriptionDateCreate
     */
    public function getSubscriptionDateCreate()
    {
        return $this->subscriptionDateCreate;
    }

    /**
     * @return the $subscriptionDateDue
     */
    public function getSubscriptionDateDue()
    {
        return $this->subscriptionDateDue;
    }

    /**
     * @return the $subscriptionDateUpdate
     */
    public function getSubscriptionDateUpdate()
    {
        return $this->subscriptionDateUpdate;
    }

    /**
     * @return the $subscriptionDateEnd
     */
    public function getSubscriptionDateEnd()
    {
        return $this->subscriptionDateEnd;
    }

    /**
     * @return the $paymentOptionId
     */
    public function getPaymentOptionId()
    {
        return $this->paymentOptionId;
    }

    /**
     * @return the $subscriptionScheduleId
     */
    public function getSubscriptionScheduleId()
    {
        return $this->subscriptionScheduleId;
    }

    /**
     * @return the $subscriptionStatusId
     */
    public function getSubscriptionStatusId()
    {
        return $this->subscriptionStatusId;
    }

    /**
     * @return the $productId
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return the $nextProductId
     */
    public function getNextProductId()
    {
        return $this->nextProductId;
    }

    /**
     * @return the $subscriptionHost
     */
    public function getSubscriptionHost()
    {
        return $this->subscriptionHost;
    }

    /**
     * @return the $subscriptionUser
     */
    public function getSubscriptionUser()
    {
        return $this->subscriptionUser;
    }

    /**
     * @return the $productEntity
     */
    public function getProductEntity()
    {
        return $this->productEntity;
    }

    /**
     * @return the $nextProductEntity
     */
    public function getNextProductEntity()
    {
        return $this->nextProductEntity;
    }

    /**
     * @return the $subscriptionStatusEntity
     */
    public function getSubscriptionStatusEntity()
    {
        return $this->subscriptionStatusEntity;
    }

    /**
     * @return the $subscriptionScheduleEntity
     */
    public function getSubscriptionScheduleEntity()
    {
        return $this->subscriptionScheduleEntity;
    }

    /**
     * @return the $paymentOptionEntity
     */
    public function getPaymentOptionEntity()
    {
        return $this->paymentOptionEntity;
    }

    /**
     * @param number $subscriptionId
     */
    public function setSubscriptionId($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
    }

    /**
     * @param number $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @param number $subscriptionDateCreate
     */
    public function setSubscriptionDateCreate($subscriptionDateCreate)
    {
        $this->subscriptionDateCreate = $subscriptionDateCreate;
    }

    /**
     * @param number $subscriptionDateDue
     */
    public function setSubscriptionDateDue($subscriptionDateDue)
    {
        $this->subscriptionDateDue = $subscriptionDateDue;
    }

    /**
     * @param number $subscriptionDateUpdate
     */
    public function setSubscriptionDateUpdate($subscriptionDateUpdate)
    {
        $this->subscriptionDateUpdate = $subscriptionDateUpdate;
    }

    /**
     * @param number $subscriptionDateEnd
     */
    public function setSubscriptionDateEnd($subscriptionDateEnd)
    {
        $this->subscriptionDateEnd = $subscriptionDateEnd;
    }

    /**
     * @param number $paymentOptionId
     */
    public function setPaymentOptionId($paymentOptionId)
    {
        $this->paymentOptionId = $paymentOptionId;
    }

    /**
     * @param number $subscriptionScheduleId
     */
    public function setSubscriptionScheduleId($subscriptionScheduleId)
    {
        $this->subscriptionScheduleId = $subscriptionScheduleId;
    }

    /**
     * @param number $subscriptionStatusId
     */
    public function setSubscriptionStatusId($subscriptionStatusId)
    {
        $this->subscriptionStatusId = $subscriptionStatusId;
    }

    /**
     * @param number $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @param number $nextProductId
     */
    public function setNextProductId($nextProductId)
    {
        $this->nextProductId = $nextProductId;
    }

    /**
     * @param boolean $subscriptionHost
     */
    public function setSubscriptionHost($subscriptionHost)
    {
        $this->subscriptionHost = $subscriptionHost;
    }

    /**
     * @param boolean $subscriptionUser
     */
    public function setSubscriptionUser($subscriptionUser)
    {
        $this->subscriptionUser = $subscriptionUser;
    }

    /**
     * @param \Product\Entity\ProductEntity $productEntity
     */
    public function setProductEntity($productEntity)
    {
        $this->productEntity = $productEntity;
    }

    /**
     * @param \Product\Entity\ProductEntity $nextProductEntity
     */
    public function setNextProductEntity($nextProductEntity)
    {
        $this->nextProductEntity = $nextProductEntity;
    }

    /**
     * @param \SubscriptionStatus\Entity\SubscriptionStatusEntity $subscriptionStatusEntity
     */
    public function setSubscriptionStatusEntity($subscriptionStatusEntity)
    {
        $this->subscriptionStatusEntity = $subscriptionStatusEntity;
    }

    /**
     * @param \SubscriptionSchedule\Entity\SubscriptionScheduleEntity $subscriptionScheduleEntity
     */
    public function setSubscriptionScheduleEntity($subscriptionScheduleEntity)
    {
        $this->subscriptionScheduleEntity = $subscriptionScheduleEntity;
    }

    /**
     * @param \PaymentOption\Entity\OptionEntity $paymentOptionEntity
     */
    public function setPaymentOptionEntity($paymentOptionEntity)
    {
        $this->paymentOptionEntity = $paymentOptionEntity;
    }


    
}