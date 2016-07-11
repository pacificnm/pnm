<?php
namespace EstimateOptionItem\Entity;

class ItemEntity
{

    /**
     *
     * @var number
     */
    protected $estimateOptionItemId;

    /**
     *
     * @var number
     */
    protected $estimateOptionId;

    /**
     *
     * @var number
     */
    protected $estimateOptionItemQty;

    /**
     *
     * @var string
     */
    protected $estimateOptionTitle;

    /**
     *
     * @var string
     */
    protected $estimateOptionItemType;

    /**
     *
     * @var float
     */
    protected $estimateOptionItemAmount;

    /**
     *
     * @var float
     */
    protected $estimateOptionItemTotal;

    /**
     *
     * @var string
     */
    protected $estimateOptionItemDescription;

    /**
     *
     * @return the $estimateOptionItemId
     */
    public function getEstimateOptionItemId()
    {
        return $this->estimateOptionItemId;
    }

    /**
     *
     * @return the $estimateOptionId
     */
    public function getEstimateOptionId()
    {
        return $this->estimateOptionId;
    }

    /**
     *
     * @return the $estimateOptionItemQty
     */
    public function getEstimateOptionItemQty()
    {
        return $this->estimateOptionItemQty;
    }

    /**
     *
     * @return the $estimateOptionTitle
     */
    public function getEstimateOptionTitle()
    {
        return $this->estimateOptionTitle;
    }

    /**
     *
     * @return the $estimateOptionItemType
     */
    public function getEstimateOptionItemType()
    {
        return $this->estimateOptionItemType;
    }

    /**
     *
     * @return the $estimateOptionItemAmount
     */
    public function getEstimateOptionItemAmount()
    {
        return $this->estimateOptionItemAmount;
    }

    /**
     *
     * @return the $estimateOptionItemTotal
     */
    public function getEstimateOptionItemTotal()
    {
        return $this->estimateOptionItemTotal;
    }

    /**
     *
     * @return the $estimateOptionItemDescription
     */
    public function getEstimateOptionItemDescription()
    {
        return $this->estimateOptionItemDescription;
    }

    /**
     *
     * @param number $estimateOptionItemId            
     */
    public function setEstimateOptionItemId($estimateOptionItemId)
    {
        $this->estimateOptionItemId = $estimateOptionItemId;
    }

    /**
     *
     * @param number $estimateOptionId            
     */
    public function setEstimateOptionId($estimateOptionId)
    {
        $this->estimateOptionId = $estimateOptionId;
    }

    /**
     *
     * @param number $estimateOptionItemQty            
     */
    public function setEstimateOptionItemQty($estimateOptionItemQty)
    {
        $this->estimateOptionItemQty = $estimateOptionItemQty;
    }

    /**
     *
     * @param string $estimateOptionTitle            
     */
    public function setEstimateOptionTitle($estimateOptionTitle)
    {
        $this->estimateOptionTitle = $estimateOptionTitle;
    }

    /**
     *
     * @param string $estimateOptionItemType            
     */
    public function setEstimateOptionItemType($estimateOptionItemType)
    {
        $this->estimateOptionItemType = $estimateOptionItemType;
    }

    /**
     *
     * @param number $estimateOptionItemAmount            
     */
    public function setEstimateOptionItemAmount($estimateOptionItemAmount)
    {
        $this->estimateOptionItemAmount = $estimateOptionItemAmount;
    }

    /**
     *
     * @param number $estimateOptionItemTotal            
     */
    public function setEstimateOptionItemTotal($estimateOptionItemTotal)
    {
        $this->estimateOptionItemTotal = $estimateOptionItemTotal;
    }

    /**
     *
     * @param string $estimateOptionItemDescription            
     */
    public function setEstimateOptionItemDescription($estimateOptionItemDescription)
    {
        $this->estimateOptionItemDescription = $estimateOptionItemDescription;
    }
}