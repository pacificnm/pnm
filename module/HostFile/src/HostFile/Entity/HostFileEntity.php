<?php
namespace HostFile\Entity;

use File\Entity\FileEntity;
use Auth\Entity\AuthEntity;

class HostFileEntity
{

    /**
     *
     * @var number
     */
    protected $hostFileId;

    /**
     *
     * @var number
     */
    protected $hostId;

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
     * @return the $hostFileId
     */
    public function getHostFileId()
    {
        return $this->hostFileId;
    }

    /**
     *
     * @return the $hostId
     */
    public function getHostId()
    {
        return $this->hostId;
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
     * @param number $hostFileId            
     */
    public function setHostFileId($hostFileId)
    {
        $this->hostFileId = $hostFileId;
    }

    /**
     *
     * @param number $hostId            
     */
    public function setHostId($hostId)
    {
        $this->hostId = $hostId;
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