<?php
namespace InvoiceOption\Entity;

class OptionEntity
{

    /**
     *
     * @var number
     */
    protected $invoiceOptionId;

    /**
     *
     * @var number
     */
    protected $invoiceOptionEnableTax;

    /**
     *
     * @var number
     */
    protected $invoiceOptionEnableDiscount;

    /**
     *
     * @var string
     */
    protected $invoiceOptionMemo;

    /**
     *
     * @var string
     */
    protected $invoiceOptionTerms;

    /**
     *
     * @return the $invoiceOptionId
     */
    public function getInvoiceOptionId()
    {
        return $this->invoiceOptionId;
    }

    /**
     *
     * @return the $invoiceOptionEnableTax
     */
    public function getInvoiceOptionEnableTax()
    {
        return $this->invoiceOptionEnableTax;
    }

    /**
     *
     * @return the $invoiceOptionEnableDiscount
     */
    public function getInvoiceOptionEnableDiscount()
    {
        return $this->invoiceOptionEnableDiscount;
    }

    /**
     *
     * @return the $invoiceOptionMemo
     */
    public function getInvoiceOptionMemo()
    {
        return $this->invoiceOptionMemo;
    }

    /**
     *
     * @return the $invoiceOptionTerms
     */
    public function getInvoiceOptionTerms()
    {
        return $this->invoiceOptionTerms;
    }

    /**
     *
     * @param number $invoiceOptionId            
     */
    public function setInvoiceOptionId($invoiceOptionId)
    {
        $this->invoiceOptionId = $invoiceOptionId;
    }

    /**
     *
     * @param number $invoiceOptionEnableTax            
     */
    public function setInvoiceOptionEnableTax($invoiceOptionEnableTax)
    {
        $this->invoiceOptionEnableTax = $invoiceOptionEnableTax;
    }

    /**
     *
     * @param number $invoiceOptionEnableDiscount            
     */
    public function setInvoiceOptionEnableDiscount($invoiceOptionEnableDiscount)
    {
        $this->invoiceOptionEnableDiscount = $invoiceOptionEnableDiscount;
    }

    /**
     *
     * @param string $invoiceOptionMemo            
     */
    public function setInvoiceOptionMemo($invoiceOptionMemo)
    {
        $this->invoiceOptionMemo = $invoiceOptionMemo;
    }

    /**
     *
     * @param string $invoiceOptionTerms            
     */
    public function setInvoiceOptionTerms($invoiceOptionTerms)
    {
        $this->invoiceOptionTerms = $invoiceOptionTerms;
    }
}
