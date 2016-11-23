<?php
namespace SubscriptionInvoice\Entity;

use Invoice\Entity\InvoiceEntity;
use Subscription\Entity\SubscriptionEntity;

class SubscriptionInvoiceEntity
{

    /**
     *
     * @var number
     */
    protected $subscriptionInvoiceId;

    /**
     *
     * @var number
     */
    protected $subscriptionId;

    /**
     *
     * @var number
     */
    protected $invoiceId;

    /**
     *
     * @var InvoiceEntity
     */
    protected $invoiceEntity;

    /**
     *
     * @var SubscriptionEntity
     */
    protected $subscriptionEntity;

    /**
     *
     * @return the $subscriptionInvoiceId
     */
    public function getSubscriptionInvoiceId()
    {
        return $this->subscriptionInvoiceId;
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
     * @return the $invoiceId
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     *
     * @return the $invoiceEntity
     */
    public function getInvoiceEntity()
    {
        return $this->invoiceEntity;
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
     * @param number $subscriptionInvoiceId            
     */
    public function setSubscriptionInvoiceId($subscriptionInvoiceId)
    {
        $this->subscriptionInvoiceId = $subscriptionInvoiceId;
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
     * @param number $invoiceId            
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }

    /**
     *
     * @param \Invoice\Entity\InvoiceEntity $invoiceEntity            
     */
    public function setInvoiceEntity($invoiceEntity)
    {
        $this->invoiceEntity = $invoiceEntity;
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