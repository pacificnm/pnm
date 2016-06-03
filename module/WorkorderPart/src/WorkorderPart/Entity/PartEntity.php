<?php
namespace WorkorderPart\Entity;

class PartEntity
{

    /**
     *
     * @var number
     */
    protected $workorderPartsId;

    /**
     *
     * @var number
     */
    protected $workorderId;

    /**
     *
     * @var number
     */
    protected $workorderPartsQty;

    /**
     *
     * @var string
     */
    protected $workorderPartsDescription;

    /**
     *
     * @var float
     */
    protected $workorderPartsAmount;

    /**
     *
     * @var float
     */
    protected $workorderPartsTotal;

    /**
     *
     * @return the $workorderPartsId
     */
    public function getWorkorderPartsId()
    {
        return $this->workorderPartsId;
    }

    /**
     *
     * @return the $workorderId
     */
    public function getWorkorderId()
    {
        return $this->workorderId;
    }

    /**
     *
     * @return the $workorderPartsQty
     */
    public function getWorkorderPartsQty()
    {
        return $this->workorderPartsQty;
    }

    /**
     *
     * @return the $workorderPartsDescription
     */
    public function getWorkorderPartsDescription()
    {
        return $this->workorderPartsDescription;
    }

    /**
     *
     * @return the $workorderPartsAmount
     */
    public function getWorkorderPartsAmount()
    {
        return $this->workorderPartsAmount;
    }

    /**
     *
     * @return the $workorderPartsTotal
     */
    public function getWorkorderPartsTotal()
    {
        return $this->workorderPartsTotal;
    }

    /**
     *
     * @param number $workorderPartsId            
     */
    public function setWorkorderPartsId($workorderPartsId)
    {
        $this->workorderPartsId = $workorderPartsId;
    }

    /**
     *
     * @param number $workorderId            
     */
    public function setWorkorderId($workorderId)
    {
        $this->workorderId = $workorderId;
    }

    /**
     *
     * @param number $workorderPartsQty            
     */
    public function setWorkorderPartsQty($workorderPartsQty)
    {
        $this->workorderPartsQty = $workorderPartsQty;
    }

    /**
     *
     * @param string $workorderPartsDescription            
     */
    public function setWorkorderPartsDescription($workorderPartsDescription)
    {
        $this->workorderPartsDescription = $workorderPartsDescription;
    }

    /**
     *
     * @param number $workorderPartsAmount            
     */
    public function setWorkorderPartsAmount($workorderPartsAmount)
    {
        $this->workorderPartsAmount = $workorderPartsAmount;
    }

    /**
     *
     * @param number $workorderPartsTotal            
     */
    public function setWorkorderPartsTotal($workorderPartsTotal)
    {
        $this->workorderPartsTotal = $workorderPartsTotal;
    }
}
