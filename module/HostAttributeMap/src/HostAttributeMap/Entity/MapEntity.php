<?php
namespace HostAttributeMap\Entity;

use HostAttribute\Entity\AttributeEntity;

class MapEntity
{

    /**
     *
     * @var number
     */
    protected $hostAttributeMapId;

    /**
     *
     * @var number
     */
    protected $hostId;

    /**
     *
     * @var number
     */
    protected $hostAttributeId;

    /**
     *
     * @var string
     */
    protected $hostAttributeMapValue;

    /**
     *
     * @var AttributeEntity
     */
    protected $attributeEntity;
    
    /**
     * @return the $hostAttributeMapId
     */
    public function getHostAttributeMapId()
    {
        return $this->hostAttributeMapId;
    }

    /**
     * @return the $hostId
     */
    public function getHostId()
    {
        return $this->hostId;
    }

    /**
     * @return the $hostAttributeId
     */
    public function getHostAttributeId()
    {
        return $this->hostAttributeId;
    }

    /**
     * @return the $hostAttributeMapValue
     */
    public function getHostAttributeMapValue()
    {
        return $this->hostAttributeMapValue;
    }

    /**
     * @return the $attributeEntity
     */
    public function getAttributeEntity()
    {
        return $this->attributeEntity;
    }

    /**
     * @param number $hostAttributeMapId
     */
    public function setHostAttributeMapId($hostAttributeMapId)
    {
        $this->hostAttributeMapId = $hostAttributeMapId;
    }

    /**
     * @param number $hostId
     */
    public function setHostId($hostId)
    {
        $this->hostId = $hostId;
    }

    /**
     * @param number $hostAttributeId
     */
    public function setHostAttributeId($hostAttributeId)
    {
        $this->hostAttributeId = $hostAttributeId;
    }

    /**
     * @param string $hostAttributeMapValue
     */
    public function setHostAttributeMapValue($hostAttributeMapValue)
    {
        $this->hostAttributeMapValue = $hostAttributeMapValue;
    }

    /**
     * @param \HostAttribute\Entity\AttributeEntity $attributeEntity
     */
    public function setAttributeEntity($attributeEntity)
    {
        $this->attributeEntity = $attributeEntity;
    }

    
    
}