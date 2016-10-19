<?php
namespace PanoramaClient\Entity;

use Client\Entity\ClientEntity;

class PanoramaClientEntity
{

    /**
     *
     * @var number
     */
    protected $panoramaClientId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $panoramaClientCid;

    /**
     *
     * @var number
     */
    protected $panoramaClientLastSync;

    /**
     *
     * @var ClientEntity
     */
    protected $clientEntity;

    /**
     *
     * @return the $panoramaClientId
     */
    public function getPanoramaClientId()
    {
        return $this->panoramaClientId;
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
     * @return the $panoramaClientCid
     */
    public function getPanoramaClientCid()
    {
        return $this->panoramaClientCid;
    }

    /**
     *
     * @return the $panoramaClientLastSync
     */
    public function getPanoramaClientLastSync()
    {
        return $this->panoramaClientLastSync;
    }

    /**
     *
     * @return the $clientEntity
     */
    public function getClientEntity()
    {
        return $this->clientEntity;
    }

    /**
     *
     * @param number $panoramaClientId            
     */
    public function setPanoramaClientId($panoramaClientId)
    {
        $this->panoramaClientId = $panoramaClientId;
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
     * @param number $panoramaClientCid            
     */
    public function setPanoramaClientCid($panoramaClientCid)
    {
        $this->panoramaClientCid = $panoramaClientCid;
    }

    /**
     *
     * @param number $panoramaClientLastSync            
     */
    public function setPanoramaClientLastSync($panoramaClientLastSync)
    {
        $this->panoramaClientLastSync = $panoramaClientLastSync;
    }

    /**
     *
     * @param \Client\Entity\ClientEntity $clientEntity            
     */
    public function setClientEntity($clientEntity)
    {
        $this->clientEntity = $clientEntity;
    }
}