<?php
namespace Network\Entity;

use NetworkAttributeMap\Entity\NetworkAttributeMapEntity;
use NetworkAttribute\Entity\NetworkAttributeEntity;

/**
 *
 * @author jaimie
 *        
 */
class NetworkEntity
{

    /**
     *
     * @var number
     */
    protected $networkId;

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
    protected $networkValue;

    /**
     *
     * @var NetworkAttributeMapEntity
     */
    protected $networkAttributeMapEntity;

    /**
     *
     * @var NetworkAttributeEntity
     */
    protected $networkAttributeEntity;

    /**
     *
     * @return the $networkId
     */
    public function getNetworkId()
    {
        return $this->networkId;
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
     * @return the $networkValue
     */
    public function getNetworkValue()
    {
        return $this->networkValue;
    }

    /**
     *
     * @return the $networkAttributeMapEntity
     */
    public function getNetworkAttributeMapEntity()
    {
        return $this->networkAttributeMapEntity;
    }

    /**
     *
     * @return the $networkAttributeEntity
     */
    public function getNetworkAttributeEntity()
    {
        return $this->networkAttributeEntity;
    }

    /**
     *
     * @param number $networkId            
     */
    public function setNetworkId($networkId)
    {
        $this->networkId = $networkId;
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
     * @param string $networkValue            
     */
    public function setNetworkValue($networkValue)
    {
        $this->networkValue = $networkValue;
    }

    /**
     *
     * @param \NetworkAttributeMap\Entity\NetworkAttributeMapEntity $networkAttributeMapEntity            
     */
    public function setNetworkAttributeMapEntity($networkAttributeMapEntity)
    {
        $this->networkAttributeMapEntity = $networkAttributeMapEntity;
    }

    /**
     *
     * @param \NetworkAttribute\Entity\NetworkAttributeEntity $networkAttributeEntity            
     */
    public function setNetworkAttributeEntity($networkAttributeEntity)
    {
        $this->networkAttributeEntity = $networkAttributeEntity;
    }
}