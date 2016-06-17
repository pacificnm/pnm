<?php
namespace HostAttribute\Entity;

class AttributeEntity
{

    /**
     *
     * @var number
     */
    protected $hostAttributeId;

    /**
     *
     * @var string
     */
    protected $hostAttributeName;

    /**
     *
     * @var string
     */
    protected $hostAttributeType;

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
     * @return the $hostAttributeName
     */
    public function getHostAttributeName()
    {
        return $this->hostAttributeName;
    }

    /**
     *
     * @return the $hostAttributeType
     */
    public function getHostAttributeType()
    {
        return $this->hostAttributeType;
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
     * @param string $hostAttributeName            
     */
    public function setHostAttributeName($hostAttributeName)
    {
        $this->hostAttributeName = $hostAttributeName;
    }

    /**
     *
     * @param string $hostAttributeType            
     */
    public function setHostAttributeType($hostAttributeType)
    {
        $this->hostAttributeType = $hostAttributeType;
    }
}