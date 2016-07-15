<?php
namespace EstimateOption\Entity;

use EstimateOptionItem\Entity\ItemEntity;

class OptionEntity
{

    /**
     *
     * @var number
     */
    protected $estimateOptionId;

    /**
     *
     * @var number
     */
    protected $estimateId;

    /**
     *
     * @var string
     */
    protected $estimateOptionTitle;

    /**
     *
     * @var string
     */
    protected $estimateOptionDecription;

    /**
     *
     * @var ItemEntity
     */
    protected $itemEntity;

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
     * @return the $estimateId
     */
    public function getEstimateId()
    {
        return $this->estimateId;
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
     * @return the $estimateOptionDecription
     */
    public function getEstimateOptionDecription()
    {
        return $this->estimateOptionDecription;
    }

    /**
     *
     * @return the $itemEntity
     */
    public function getItemEntity()
    {
        return $this->itemEntity;
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
     * @param number $estimateId            
     */
    public function setEstimateId($estimateId)
    {
        $this->estimateId = $estimateId;
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
     * @param string $estimateOptionDecription            
     */
    public function setEstimateOptionDecription($estimateOptionDecription)
    {
        $this->estimateOptionDecription = $estimateOptionDecription;
    }

    /**
     *
     * @param \EstimateOptionItem\Entity\ItemEntity $itemEntity            
     */
    public function setItemEntity($itemEntity)
    {
        $this->itemEntity = $itemEntity;
    }
}