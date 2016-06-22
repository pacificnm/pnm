<?php
namespace VendorAccount\Entity;

class AccountEntity
{

    /**
     *
     * @var number
     */
    protected $vendorAccountId;

    /**
     *
     * @var number
     */
    protected $accountId;

    /**
     *
     * @var number
     */
    protected $vendorId;

    /**
     *
     * @return the $vendorAccountId
     */
    public function getVendorAccountId()
    {
        return $this->vendorAccountId;
    }

    /**
     *
     * @return the $accountId
     */
    public function getAccountId()
    {
        return $this->accountId;
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
     * @param number $vendorAccountId            
     */
    public function setVendorAccountId($vendorAccountId)
    {
        $this->vendorAccountId = $vendorAccountId;
    }

    /**
     *
     * @param number $accountId            
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     *
     * @param number $vendorId            
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }
}