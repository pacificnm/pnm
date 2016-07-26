<?php
namespace WorkorderFile\Entity;

class WorkorderFileEntity
{

    /**
     *
     * @var number
     */
    protected $workorderFileId;

    /**
     *
     * @var number
     */
    protected $workorderId;

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
     * @return the $workorderFileId
     */
    public function getWorkorderFileId()
    {
        return $this->workorderFileId;
    }

    /**
     *
     * @return the $workorderId
     */
    public function getWorkorderId()
    {
        return $this->workorderId;
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
     * @param number $workorderFileId            
     */
    public function setWorkorderFileId($workorderFileId)
    {
        $this->workorderFileId = $workorderFileId;
    }

    /**
     *
     * @param number $workorderId            
     */
    public function setWorkorderId($workorderId)
    {
        $this->workorderId = $workorderId;
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
     * @param \WorkorderFile\Entity\FileEntity $fileEntity            
     */
    public function setFileEntity($fileEntity)
    {
        $this->fileEntity = $fileEntity;
    }
}

