<?php
namespace VendorBill\Entity;

use Vendor\Entity\VendorEntity;

class BillEntity
{

    /**
     *
     * @var number
     */
    protected $vendorBillId;

    /**
     *
     * @var number
     */
    protected $vendorId;

    /**
     *
     * @var number
     */
    protected $vendorBillDateCreate;

    /**
     *
     * @var number
     */
    protected $vendorBillDateDue;

    /**
     *
     * @var number
     */
    protected $vendorBillDatePaid;

    /**
     *
     * @var float
     */
    protected $vendorBillAmount;

    /**
     *
     * @var float
     */
    protected $vendorBillBalance;

    /**
     *
     * @var string
     */
    protected $vendorBillMemo;

    /**
     *
     * @var string
     */
    protected $vendorBillStatus;

    /**
     *
     * @var VendorEntity
     */
    protected $vendorEntity;

    /**
     *
     * @return the $vendorBillId
     */
    public function getVendorBillId()
    {
        return $this->vendorBillId;
    }

    /**
     *
     * @return the $vendorId
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     *
     * @return the $vendorBillDateCreate
     */
    public function getVendorBillDateCreate()
    {
        return $this->vendorBillDateCreate;
    }

    /**
     *
     * @return the $vendorBillDateDue
     */
    public function getVendorBillDateDue()
    {
        return $this->vendorBillDateDue;
    }

    /**
     *
     * @return the $vendorBillDatePaid
     */
    public function getVendorBillDatePaid()
    {
        return $this->vendorBillDatePaid;
    }

    /**
     *
     * @return the $vendorBillAmount
     */
    public function getVendorBillAmount()
    {
        return $this->vendorBillAmount;
    }

    /**
     *
     * @return the $vendorBillBalance
     */
    public function getVendorBillBalance()
    {
        return $this->vendorBillBalance;
    }

    /**
     *
     * @return the $vendorBillMemo
     */
    public function getVendorBillMemo()
    {
        return $this->vendorBillMemo;
    }

    /**
     *
     * @return the $vendorBillStatus
     */
    public function getVendorBillStatus()
    {
        return $this->vendorBillStatus;
    }

    /**
     *
     * @return the $vendorEntity
     */
    public function getVendorEntity()
    {
        return $this->vendorEntity;
    }

    /**
     *
     * @param number $vendorBillId            
     */
    public function setVendorBillId($vendorBillId)
    {
        $this->vendorBillId = $vendorBillId;
    }

    /**
     *
     * @param number $vendorId            
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     *
     * @param number $vendorBillDateCreate            
     */
    public function setVendorBillDateCreate($vendorBillDateCreate)
    {
        $this->vendorBillDateCreate = $vendorBillDateCreate;
    }

    /**
     *
     * @param number $vendorBillDateDue            
     */
    public function setVendorBillDateDue($vendorBillDateDue)
    {
        $this->vendorBillDateDue = $vendorBillDateDue;
    }

    /**
     *
     * @param number $vendorBillDatePaid            
     */
    public function setVendorBillDatePaid($vendorBillDatePaid)
    {
        $this->vendorBillDatePaid = $vendorBillDatePaid;
    }

    /**
     *
     * @param number $vendorBillAmount            
     */
    public function setVendorBillAmount($vendorBillAmount)
    {
        $this->vendorBillAmount = $vendorBillAmount;
    }

    /**
     *
     * @param number $vendorBillBalance            
     */
    public function setVendorBillBalance($vendorBillBalance)
    {
        $this->vendorBillBalance = $vendorBillBalance;
    }

    /**
     *
     * @param string $vendorBillMemo            
     */
    public function setVendorBillMemo($vendorBillMemo)
    {
        $this->vendorBillMemo = $vendorBillMemo;
    }

    /**
     *
     * @param string $vendorBillStatus            
     */
    public function setVendorBillStatus($vendorBillStatus)
    {
        $this->vendorBillStatus = $vendorBillStatus;
    }

    /**
     *
     * @param \Vendor\Entity\VendorEntity $vendorEntity            
     */
    public function setVendorEntity($vendorEntity)
    {
        $this->vendorEntity = $vendorEntity;
    }
}