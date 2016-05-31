<?php
namespace Labor\Entity;

class LaborEntity implements LaborEntityInterface
{

    /**
     *
     * @var number
     */
    protected $laborId;

    /**
     *
     * @var string
     */
    protected $laborName;

    /**
     *
     * @var float
     */
    protected $laborAmount;

    /**
     *
     * @return the $laborId
     */
    public function getLaborId()
    {
        return $this->laborId;
    }

    /**
     *
     * @return the $laborName
     */
    public function getLaborName()
    {
        return $this->laborName;
    }

    /**
     *
     * @return the $laborAmount
     */
    public function getLaborAmount()
    {
        return $this->laborAmount;
    }

    /**
     *
     * @param number $laborId            
     */
    public function setLaborId($laborId)
    {
        $this->laborId = $laborId;
    }

    /**
     *
     * @param string $laborName            
     */
    public function setLaborName($laborName)
    {
        $this->laborName = $laborName;
    }

    /**
     *
     * @param number $laborAmount            
     */
    public function setLaborAmount($laborAmount)
    {
        $this->laborAmount = $laborAmount;
    }
}