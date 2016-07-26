<?php
namespace File\Entity;

use Employee\Entity\EmployeeEntity;

class FileEntity
{

    /**
     *
     * @var number
     */
    protected $fileId;

    /**
     *
     * @var number
     */
    protected $authId;

    /**
     *
     * @var string
     */
    protected $fileTitle;

    /**
     *
     * @var string
     */
    protected $fileName;

    /**
     *
     * @var string
     */
    protected $filePath;

    /**
     *
     * @var string
     */
    protected $fileMime;

    /**
     *
     * @var float
     */
    protected $fileSize;

    /**
     *
     * @var number
     */
    protected $fileCreate;

    /**
     *
     * @var EmployeeEntity
     */
    protected $employeeEntity;

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
     * @return the $authId
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     *
     * @return the $fileTitle
     */
    public function getFileTitle()
    {
        return $this->fileTitle;
    }

    /**
     *
     * @return the $fileName
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     *
     * @return the $filePath
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     *
     * @return the $fileMime
     */
    public function getFileMime()
    {
        return $this->fileMime;
    }

    /**
     *
     * @return the $fileSize
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     *
     * @return the $fileCreate
     */
    public function getFileCreate()
    {
        return $this->fileCreate;
    }

    /**
     *
     * @return the $employeeEntity
     */
    public function getEmployeeEntity()
    {
        return $this->employeeEntity;
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
     * @param number $authId            
     */
    public function setAuthId($authId)
    {
        $this->authId = $authId;
    }

    /**
     *
     * @param string $fileTitle            
     */
    public function setFileTitle($fileTitle)
    {
        $this->fileTitle = $fileTitle;
    }

    /**
     *
     * @param string $fileName            
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     *
     * @param string $filePath            
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     *
     * @param string $fileMime            
     */
    public function setFileMime($fileMime)
    {
        $this->fileMime = $fileMime;
    }

    /**
     *
     * @param number $fileSize            
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    /**
     *
     * @param number $fileCreate            
     */
    public function setFileCreate($fileCreate)
    {
        $this->fileCreate = $fileCreate;
    }

    /**
     *
     * @param \Employee\Entity\EmployeeEntity $employeeEntity            
     */
    public function setEmployeeEntity($employeeEntity)
    {
        $this->employeeEntity = $employeeEntity;
    }
}

