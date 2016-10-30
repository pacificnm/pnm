<?php
namespace Product\Entity;

class ProductEntity
{

    /**
     *
     * @var number
     */
    protected $productId;

    /**
     *
     * @var string
     */
    protected $productName;

    /**
     *
     * @var string
     */
    protected $productDescriptionShort;

    /**
     *
     * @var string
     */
    protected $productDescriptionLong;

    /**
     *
     * @var float
     */
    protected $productFee;

    /**
     *
     * @var float
     */
    protected $productFeeSetup;

    /**
     *
     * @var float
     */
    protected $productFeeMonthly;

    /**
     *
     * @var float
     */
    protected $productFeeAnual;

    /**
     *
     * @var string
     */
    protected $productImage;

    /**
     *
     * @var number
     */
    protected $productStatus;

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
     * @return the $productName
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     *
     * @return the $productDescriptionShort
     */
    public function getProductDescriptionShort()
    {
        return $this->productDescriptionShort;
    }

    /**
     *
     * @return the $productDescriptionLong
     */
    public function getProductDescriptionLong()
    {
        return $this->productDescriptionLong;
    }

    /**
     *
     * @return the $productFee
     */
    public function getProductFee()
    {
        return $this->productFee;
    }

    /**
     *
     * @return the $productFeeSetup
     */
    public function getProductFeeSetup()
    {
        return $this->productFeeSetup;
    }

    /**
     *
     * @return the $productFeeMonthly
     */
    public function getProductFeeMonthly()
    {
        return $this->productFeeMonthly;
    }

    /**
     *
     * @return the $productFeeAnual
     */
    public function getProductFeeAnual()
    {
        return $this->productFeeAnual;
    }

    /**
     *
     * @return the $productImage
     */
    public function getProductImage()
    {
        return $this->productImage;
    }

    /**
     *
     * @return the $productStatus
     */
    public function getProductStatus()
    {
        return $this->productStatus;
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
     * @param string $productName            
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     *
     * @param string $productDescriptionShort            
     */
    public function setProductDescriptionShort($productDescriptionShort)
    {
        $this->productDescriptionShort = $productDescriptionShort;
    }

    /**
     *
     * @param string $productDescriptionLong            
     */
    public function setProductDescriptionLong($productDescriptionLong)
    {
        $this->productDescriptionLong = $productDescriptionLong;
    }

    /**
     *
     * @param number $productFee            
     */
    public function setProductFee($productFee)
    {
        $this->productFee = $productFee;
    }

    /**
     *
     * @param number $productFeeSetup            
     */
    public function setProductFeeSetup($productFeeSetup)
    {
        $this->productFeeSetup = $productFeeSetup;
    }

    /**
     *
     * @param number $productFeeMonthly            
     */
    public function setProductFeeMonthly($productFeeMonthly)
    {
        $this->productFeeMonthly = $productFeeMonthly;
    }

    /**
     *
     * @param number $productFeeAnual            
     */
    public function setProductFeeAnual($productFeeAnual)
    {
        $this->productFeeAnual = $productFeeAnual;
    }

    /**
     *
     * @param string $productImage            
     */
    public function setProductImage($productImage)
    {
        $this->productImage = $productImage;
    }

    /**
     *
     * @param number $productStatus            
     */
    public function setProductStatus($productStatus)
    {
        $this->productStatus = $productStatus;
    }
}