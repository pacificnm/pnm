<?php
namespace NetworkAttributeMap\Entity;

class NetworkAttributeMapEntity
{

    /**
     *
     * @var number
     */
    protected $networkAttributeMapId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $networkAttributeId;

    /**
     *
     * @var string
     */
    protected $networkAttributeMapValue;

    /**
     *
     * @return the $networkAttributeMapId
     */
    public function getNetworkAttributeMapId()
    {
        return $this->networkAttributeMapId;
    }

    /**
     *
     * @return the $clientId
     */
    public function getClientId()
    {
        return $this->clientId;
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
     * @return the $networkAttributeMapValue
     */
    public function getNetworkAttributeMapValue()
    {
        return $this->networkAttributeMapValue;
    }

    /**
     *
     * @param number $networkAttributeMapId            
     */
    public function setNetworkAttributeMapId($networkAttributeMapId)
    {
        $this->networkAttributeMapId = $networkAttributeMapId;
    }

    /**
     *
     * @param number $clientId            
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
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
     * @param string $networkAttributeMapValue            
     */
    public function setNetworkAttributeMapValue($networkAttributeMapValue)
    {
        $this->networkAttributeMapValue = $networkAttributeMapValue;
    }
}