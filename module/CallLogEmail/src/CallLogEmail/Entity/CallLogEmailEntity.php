<?php
namespace CallLogEmail\Entity;

use Email\Entity\EmailEntity;
use CallLog\Entity\LogEntity;

class CallLogEmailEntity
{

    /**
     *
     * @var number
     */
    protected $callLogEmailId;

    /**
     *
     * @var number
     */
    protected $callLogId;

    /**
     *
     * @var number
     */
    protected $emailId;

    /**
     *
     * @var EmailEntity
     */
    protected $emailEntity;

    /**
     *
     * @var LogEntity
     */
    protected $logEntity;

    /**
     *
     * @return the $callLogEmailId
     */
    public function getCallLogEmailId()
    {
        return $this->callLogEmailId;
    }

    /**
     *
     * @return the $callLogId
     */
    public function getCallLogId()
    {
        return $this->callLogId;
    }

    /**
     *
     * @return the $emailId
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     *
     * @return the $emailEntity
     */
    public function getEmailEntity()
    {
        return $this->emailEntity;
    }

    /**
     *
     * @return the $logEntity
     */
    public function getLogEntity()
    {
        return $this->logEntity;
    }

    /**
     *
     * @param number $callLogEmailId            
     */
    public function setCallLogEmailId($callLogEmailId)
    {
        $this->callLogEmailId = $callLogEmailId;
    }

    /**
     *
     * @param number $callLogId            
     */
    public function setCallLogId($callLogId)
    {
        $this->callLogId = $callLogId;
    }

    /**
     *
     * @param number $emailId            
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;
    }

    /**
     *
     * @param \Email\Entity\EmailEntity $emailEntity            
     */
    public function setEmailEntity($emailEntity)
    {
        $this->emailEntity = $emailEntity;
    }

    /**
     *
     * @param \CallLog\Entity\LogEntity $logEntity            
     */
    public function setLogEntity($logEntity)
    {
        $this->logEntity = $logEntity;
    }
}