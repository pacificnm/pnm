<?php
namespace VendorPayment\Entity;

use Account\Entity\AccountEntity;
class PaymentEntity
{

    /**
     *
     * @var number
     */
    protected $vendorPaymentId;

    /**
     *
     * @var number
     */
    protected $vendorId;

    /**
     *
     * @var number
     */
    protected $vendorBillId;

    /**
     *
     * @var number
     */
    protected $accountId;

    /**
     *
     * @var number
     */
    protected $accountLedgerId;

    /**
     *
     * @var number
     */
    protected $vendorPaymentDate;

    /**
     *
     * @var float
     */
    protected $vendorPaymentAmount;

    /**
     *
     * @var number
     */
    protected $vendorPaymentActive;

    /**
     * 
     * @var AccountEntity
     */
    protected $accountEntity;
    
    /**
     * @return the $vendorPaymentId
     */
    public function getVendorPaymentId()
    {
        return $this->vendorPaymentId;
    }

    /**
     * @return the $vendorId
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * @return the $vendorBillId
     */
    public function getVendorBillId()
    {
        return $this->vendorBillId;
    }

    /**
     * @return the $accountId
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @return the $accountLedgerId
     */
    public function getAccountLedgerId()
    {
        return $this->accountLedgerId;
    }

    /**
     * @return the $vendorPaymentDate
     */
    public function getVendorPaymentDate()
    {
        return $this->vendorPaymentDate;
    }

    /**
     * @return the $vendorPaymentAmount
     */
    public function getVendorPaymentAmount()
    {
        return $this->vendorPaymentAmount;
    }

    /**
     * @return the $vendorPaymentActive
     */
    public function getVendorPaymentActive()
    {
        return $this->vendorPaymentActive;
    }

    /**
     * @return the $accountEntity
     */
    public function getAccountEntity()
    {
        return $this->accountEntity;
    }

    /**
     * @param number $vendorPaymentId
     */
    public function setVendorPaymentId($vendorPaymentId)
    {
        $this->vendorPaymentId = $vendorPaymentId;
    }

    /**
     * @param number $vendorId
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @param number $vendorBillId
     */
    public function setVendorBillId($vendorBillId)
    {
        $this->vendorBillId = $vendorBillId;
    }

    /**
     * @param number $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @param number $accountLedgerId
     */
    public function setAccountLedgerId($accountLedgerId)
    {
        $this->accountLedgerId = $accountLedgerId;
    }

    /**
     * @param number $vendorPaymentDate
     */
    public function setVendorPaymentDate($vendorPaymentDate)
    {
        $this->vendorPaymentDate = $vendorPaymentDate;
    }

    /**
     * @param number $vendorPaymentAmount
     */
    public function setVendorPaymentAmount($vendorPaymentAmount)
    {
        $this->vendorPaymentAmount = $vendorPaymentAmount;
    }

    /**
     * @param number $vendorPaymentActive
     */
    public function setVendorPaymentActive($vendorPaymentActive)
    {
        $this->vendorPaymentActive = $vendorPaymentActive;
    }

    /**
     * @param \Account\Entity\AccountEntity $accountEntity
     */
    public function setAccountEntity($accountEntity)
    {
        $this->accountEntity = $accountEntity;
    }

    
}
