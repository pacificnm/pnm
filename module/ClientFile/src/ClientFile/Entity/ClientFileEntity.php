<?php
namespace ClientFile\Entity;

use File\Entity\FileEntity;
use Auth\Entity\AuthEntity;

class ClientFileEntity
{

    /**
     *
     * @var number
     */
    protected $clientFileId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $fileId;

    /**
     *
     * @var FileEntity
     */
    protected $fileEntity;

    /**
     *
     * @var AuthEntity
     */
    protected $authEntity;

    /**
     *
     * @return the $clientFileId
     */
    public function getClientFileId()
    {
        return $this->clientFileId;
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
     * @return the $fileId
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     *
     * @return the $fileEntity
     */
    public function getFileEntity()
    {
        return $this->fileEntity;
    }

    /**
     *
     * @return the $authEntity
     */
    public function getAuthEntity()
    {
        return $this->authEntity;
    }

    /**
     *
     * @param number $clientFileId            
     */
    public function setClientFileId($clientFileId)
    {
        $this->clientFileId = $clientFileId;
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
     * @param number $fileId            
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;
    }

    /**
     *
     * @param \File\Entity\FileEntity $fileEntity            
     */
    public function setFileEntity($fileEntity)
    {
        $this->fileEntity = $fileEntity;
    }

    /**
     *
     * @param \Auth\Entity\AuthEntity $authEntity            
     */
    public function setAuthEntity($authEntity)
    {
        $this->authEntity = $authEntity;
    }
}
