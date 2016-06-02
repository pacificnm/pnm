<?php
namespace NetworkAttributeValue\Entity;

class NetworkAttributeValueEntity
{

    /**
     *
     * @var number
     */
    protected $networkAttributeValueId;

    /**
     *
     * @var number
     */
    protected $networkAttributeId;

    /**
     *
     * @var string
     */
    protected $networkAttributeValueName;

    /**
     *
     * @return the $networkAttributeValueId
     */
    public function getNetworkAttributeValueId()
    {
        return $this->networkAttributeValueId;
    }

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
     * @return the $networkAttributeValueName
     */
    public function getNetworkAttributeValueName()
    {
        return $this->networkAttributeValueName;
    }

    /**
     *
     * @param number $networkAttributeValueId            
     */
    public function setNetworkAttributeValueId($networkAttributeValueId)
    {
        $this->networkAttributeValueId = $networkAttributeValueId;
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
     * @param string $networkAttributeValueName            
     */
    public function setNetworkAttributeValueName($networkAttributeValueName)
    {
        $this->networkAttributeValueName = $networkAttributeValueName;
    }
}