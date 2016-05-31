<?php
namespace Invoice\Entity;

class InvoiceEntity
{

    /**
     *
     * @var number
     */
    protected $invoiceId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $invoiceDate;

    /**
     *
     * @var number
     */
    protected $invoiceDateStart;

    /**
     *
     * @var number
     */
    protected $invoiceDateEnd;

    /**
     *
     * @var float
     */
    protected $invoiceSubtotal;

    /**
     *
     * @var float
     */
    protected $invoiceTax;

    /**
     *
     * @var float
     */
    protected $invoiceDiscount;

    /**
     *
     * @var float
     */
    protected $invoiceTotal;

    /**
     *
     * @var float
     */
    protected $invoicePayment;

    /**
     *
     * @var float
     */
    protected $invoiceBalance;

    /**
     *
     * @var string
     */
    protected $invoiceStatus;

    /**
     *
     * @var number
     */
    protected $invoiceDatePaid;

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
     * @return the $clientId
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     *
     * @return the $invoiceDate
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     *
     * @return the $invoiceDateStart
     */
    public function getInvoiceDateStart()
    {
        return $this->invoiceDateStart;
    }

    /**
     *
     * @return the $invoiceDateEnd
     */
    public function getInvoiceDateEnd()
    {
        return $this->invoiceDateEnd;
    }

    /**
     *
     * @return the $invoiceSubtotal
     */
    public function getInvoiceSubtotal()
    {
        return $this->invoiceSubtotal;
    }

    /**
     *
     * @return the $invoiceTax
     */
    public function getInvoiceTax()
    {
        return $this->invoiceTax;
    }

    /**
     *
     * @return the $invoiceDiscount
     */
    public function getInvoiceDiscount()
    {
        return $this->invoiceDiscount;
    }

    /**
     *
     * @return the $invoiceTotal
     */
    public function getInvoiceTotal()
    {
        return $this->invoiceTotal;
    }

    /**
     *
     * @return the $invoicePayment
     */
    public function getInvoicePayment()
    {
        return $this->invoicePayment;
    }

    /**
     *
     * @return the $invoiceBalance
     */
    public function getInvoiceBalance()
    {
        return $this->invoiceBalance;
    }

    /**
     *
     * @return the $invoiceStatus
     */
    public function getInvoiceStatus()
    {
        return $this->invoiceStatus;
    }

    /**
     *
     * @return the $invoiceDatePaid
     */
    public function getInvoiceDatePaid()
    {
        return $this->invoiceDatePaid;
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
     * @param number $clientId            
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     *
     * @param number $invoiceDate            
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;
    }

    /**
     *
     * @param number $invoiceDateStart            
     */
    public function setInvoiceDateStart($invoiceDateStart)
    {
        $this->invoiceDateStart = $invoiceDateStart;
    }

    /**
     *
     * @param number $invoiceDateEnd            
     */
    public function setInvoiceDateEnd($invoiceDateEnd)
    {
        $this->invoiceDateEnd = $invoiceDateEnd;
    }

    /**
     *
     * @param number $invoiceSubtotal            
     */
    public function setInvoiceSubtotal($invoiceSubtotal)
    {
        $this->invoiceSubtotal = $invoiceSubtotal;
    }

    /**
     *
     * @param number $invoiceTax            
     */
    public function setInvoiceTax($invoiceTax)
    {
        $this->invoiceTax = $invoiceTax;
    }

    /**
     *
     * @param number $invoiceDiscount            
     */
    public function setInvoiceDiscount($invoiceDiscount)
    {
        $this->invoiceDiscount = $invoiceDiscount;
    }

    /**
     *
     * @param number $invoiceTotal            
     */
    public function setInvoiceTotal($invoiceTotal)
    {
        $this->invoiceTotal = $invoiceTotal;
    }

    /**
     *
     * @param number $invoicePayment            
     */
    public function setInvoicePayment($invoicePayment)
    {
        $this->invoicePayment = $invoicePayment;
    }

    /**
     *
     * @param number $invoiceBalance            
     */
    public function setInvoiceBalance($invoiceBalance)
    {
        $this->invoiceBalance = $invoiceBalance;
    }

    /**
     *
     * @param string $invoiceStatus            
     */
    public function setInvoiceStatus($invoiceStatus)
    {
        $this->invoiceStatus = $invoiceStatus;
    }

    /**
     *
     * @param number $invoiceDatePaid            
     */
    public function setInvoiceDatePaid($invoiceDatePaid)
    {
        $this->invoiceDatePaid = $invoiceDatePaid;
    }
}