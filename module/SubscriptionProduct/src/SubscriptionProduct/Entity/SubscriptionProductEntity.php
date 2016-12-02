<?php
namespace SubscriptionProduct\Entity;

use Product\Entity\ProductEntity;

class SubscriptionProductEntity
{

    /**
     *
     * @var number
     */
    protected $subscriptionProductId;

    /**
     *
     * @var number
     */
    protected $subscriptionId;

    /**
     *
     * @var number
     */
    protected $productId;

    /**
     *
     * @var number
     */
    protected $subscriptionProductQty;

    /**
     *
     * @var bool
     */
    protected $subscriptionProductStatus;

    /**
     *
     * @var ProductEntity
     */
    protected $productEntity;

    /**
     *
     * @return the $subscriptionProductId
     */
    public function getSubscriptionProductId()
    {
        return $this->subscriptionProductId;
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
     * @return the $productId
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     *
     * @return the $subscriptionProductQty
     */
    public function getSubscriptionProductQty()
    {
        return $this->subscriptionProductQty;
    }

    /**
     *
     * @return the $subscriptionProductStatus
     */
    public function getSubscriptionProductStatus()
    {
        return $this->subscriptionProductStatus;
    }

    /**
     *
     * @return the $productEntity
     */
    public function getProductEntity()
    {
        return $this->productEntity;
    }

    /**
     *
     * @param number $subscriptionProductId            
     */
    public function setSubscriptionProductId($subscriptionProductId)
    {
        $this->subscriptionProductId = $subscriptionProductId;
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
     * @param number $productId            
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     *
     * @param number $subscriptionProductQty            
     */
    public function setSubscriptionProductQty($subscriptionProductQty)
    {
        $this->subscriptionProductQty = $subscriptionProductQty;
    }

    /**
     *
     * @param boolean $subscriptionProductStatus            
     */
    public function setSubscriptionProductStatus($subscriptionProductStatus)
    {
        $this->subscriptionProductStatus = $subscriptionProductStatus;
    }

    /**
     *
     * @param \Product\Entity\ProductEntity $productEntity            
     */
    public function setProductEntity($productEntity)
    {
        $this->productEntity = $productEntity;
    }
}

