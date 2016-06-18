<?php
namespace HostAttributeValue\Entity;

class ValueEntity
{

    /**
     *
     * @var number
     */
    protected $hostAttributeValueId;

    /**
     *
     * @var number
     */
    protected $hostAttributeId;

    /**
     *
     * @var string
     */
    protected $hostAttributeValueName;

    /**
     *
     * @return the $hostAttributeValueId
     */
    public function getHostAttributeValueId()
    {
        return $this->hostAttributeValueId;
    }

    /**
     *
     * @return the $hostAttributeId
     */
    public function getHostAttributeId()
    {
        return $this->hostAttributeId;
    }

    /**
     *
     * @return the $hostAttributeValueName
     */
    public function getHostAttributeValueName()
    {
        return $this->hostAttributeValueName;
    }

    /**
     *
     * @param number $hostAttributeValueId            
     */
    public function setHostAttributeValueId($hostAttributeValueId)
    {
        $this->hostAttributeValueId = $hostAttributeValueId;
    }

    /**
     *
     * @param number $hostAttributeId            
     */
    public function setHostAttributeId($hostAttributeId)
    {
        $this->hostAttributeId = $hostAttributeId;
    }

    /**
     *
     * @param string $hostAttributeValueName            
     */
    public function setHostAttributeValueName($hostAttributeValueName)
    {
        $this->hostAttributeValueName = $hostAttributeValueName;
    }
}