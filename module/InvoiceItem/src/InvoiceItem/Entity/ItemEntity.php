<?php
namespace InvoiceItem\Entity;

class ItemEntity
{

    /**
     *
     * @var number
     */
    protected $invoiceItemId;

    /**
     *
     * @var number
     */
    protected $invoiceId;

    /**
     *
     * @var number
     */
    protected $invoiceItemQty;

    /**
     *
     * @var string
     */
    protected $invoiceItemDescrip;

    /**
     *
     * @var float
     */
    protected $invoiceItemAmount;

    /**
     *
     * @var float
     */
    protected $invoiceItemTotal;

    /**
     *
     * @var string
     */
    protected $invoiceItemDate;

    /**
     *
     * @return the $invoiceItemId
     */
    public function getInvoiceItemId()
    {
        return $this->invoiceItemId;
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
     * @return the $invoiceItemQty
     */
    public function getInvoiceItemQty()
    {
        return $this->invoiceItemQty;
    }

    /**
     *
     * @return the $invoiceItemDescrip
     */
    public function getInvoiceItemDescrip()
    {
        return $this->invoiceItemDescrip;
    }

    /**
     *
     * @return the $invoiceItemAmount
     */
    public function getInvoiceItemAmount()
    {
        return $this->invoiceItemAmount;
    }

    /**
     *
     * @return the $invoiceItemTotal
     */
    public function getInvoiceItemTotal()
    {
        return $this->invoiceItemTotal;
    }

    /**
     *
     * @return the $invoiceItemDate
     */
    public function getInvoiceItemDate()
    {
        return $this->invoiceItemDate;
    }

    /**
     *
     * @param number $invoiceItemId            
     */
    public function setInvoiceItemId($invoiceItemId)
    {
        $this->invoiceItemId = $invoiceItemId;
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
     * @param number $invoiceItemQty            
     */
    public function setInvoiceItemQty($invoiceItemQty)
    {
        $this->invoiceItemQty = $invoiceItemQty;
    }

    /**
     *
     * @param string $invoiceItemDescrip            
     */
    public function setInvoiceItemDescrip($invoiceItemDescrip)
    {
        $this->invoiceItemDescrip = $invoiceItemDescrip;
    }

    /**
     *
     * @param number $invoiceItemAmount            
     */
    public function setInvoiceItemAmount($invoiceItemAmount)
    {
        $this->invoiceItemAmount = $invoiceItemAmount;
    }

    /**
     *
     * @param number $invoiceItemTotal            
     */
    public function setInvoiceItemTotal($invoiceItemTotal)
    {
        $this->invoiceItemTotal = $invoiceItemTotal;
    }

    /**
     *
     * @param string $invoiceItemDate            
     */
    public function setInvoiceItemDate($invoiceItemDate)
    {
        $this->invoiceItemDate = $invoiceItemDate;
    }
}
