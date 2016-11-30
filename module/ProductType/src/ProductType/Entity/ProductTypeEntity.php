<?php
namespace ProductType\Entity;

class ProductTypeEntity
{

    /**
     *
     * @var number
     */
    protected $productTypeId;

    /**
     *
     * @var string
     */
    protected $productTypeName;

    /**
     *
     * @var bool
     */
    protected $productTypeStatus;

    /**
     *
     * @return the $productTypeId
     */
    public function getProductTypeId()
    {
        return $this->productTypeId;
    }

    /**
     *
     * @return the $productTypeName
     */
    public function getProductTypeName()
    {
        return $this->productTypeName;
    }

    /**
     *
     * @return the $productTypeStatus
     */
    public function getProductTypeStatus()
    {
        return $this->productTypeStatus;
    }

    /**
     *
     * @param number $productTypeId            
     */
    public function setProductTypeId($productTypeId)
    {
        $this->productTypeId = $productTypeId;
    }

    /**
     *
     * @param string $productTypeName            
     */
    public function setProductTypeName($productTypeName)
    {
        $this->productTypeName = $productTypeName;
    }

    /**
     *
     * @param boolean $productTypeStatus            
     */
    public function setProductTypeStatus($productTypeStatus)
    {
        $this->productTypeStatus = $productTypeStatus;
    }
}

