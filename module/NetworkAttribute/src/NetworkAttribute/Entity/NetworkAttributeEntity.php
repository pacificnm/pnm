<?php
namespace NetworkAttribute\Entity;

class NetworkAttributeEntity
{

    /**
     *
     * @var number
     */
    protected $networkAttributeId;

    /**
     *
     * @var string
     */
    protected $networkAttributeName;

    /**
     *
     * @var string
     */
    protected $networkAttributeType;

    /**
     *
     * @return the $networkAttributeId
     */
    public function getNetworkAttributeId()
    {
        return $this->networkAttributeId;
    }

    /**
     *
     * @return the $networkAttributeName
     */
    public function getNetworkAttributeName()
    {
        return $this->networkAttributeName;
    }

    /**
     *
     * @return the $networkAttributeType
     */
    public function getNetworkAttributeType()
    {
        return $this->networkAttributeType;
    }

    /**
     *
     * @param number $networkAttributeId            
     */
    public function setNetworkAttributeId($networkAttributeId)
    {
        $this->networkAttributeId = $networkAttributeId;
    }

    /**
     *
     * @param string $networkAttributeName            
     */
    public function setNetworkAttributeName($networkAttributeName)
    {
        $this->networkAttributeName = $networkAttributeName;
    }

    /**
     *
     * @param string $networkAttributeType            
     */
    public function setNetworkAttributeType($networkAttributeType)
    {
        $this->networkAttributeType = $networkAttributeType;
    }
}