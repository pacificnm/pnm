<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace CallLog\Entity;

use Employee\Entity\EmployeeEntity;
use Auth\Entity\AuthEntity;
use Client\Entity\ClientEntity;

class LogEntity
{

    /**
     *
     * @var number
     */
    protected $callLogId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $employeeId;

    /**
     *
     * @var number
     */
    protected $callLogTime;

    /**
     *
     * @var string
     */
    protected $callLogDetail;

    /**
     *
     * @var bool
     */
    protected $callLogRequireCallBack;

    /**
     *
     * @var bool
     */
    protected $callLogWillCallBack;

    /**
     *
     * @var bool
     */
    protected $callLogVoiceMail;

    /**
     *
     * @var bool
     */
    protected $callLogUrgent;

    /**
     *
     * @var bool
     */
    protected $callLogRead;

    /**
     *
     * @var number
     */
    protected $callLogCreatedBy;

    /**
     *
     * @var EmployeeEntity
     */
    protected $employeeEntity;

    /**
     *
     * @var AuthEntity
     */
    protected $authEntity;

    /**
     *
     * @var ClientEntity
     */
    protected $clientEntity;

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
     * @return the $clientId
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     *
     * @return the $employeeId
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     *
     * @return the $callLogTime
     */
    public function getCallLogTime()
    {
        return $this->callLogTime;
    }

    /**
     *
     * @return the $callLogDetail
     */
    public function getCallLogDetail()
    {
        return $this->callLogDetail;
    }

    /**
     *
     * @return the $callLogRequireCallBack
     */
    public function getCallLogRequireCallBack()
    {
        return $this->callLogRequireCallBack;
    }

    /**
     *
     * @return the $callLogWillCallBack
     */
    public function getCallLogWillCallBack()
    {
        return $this->callLogWillCallBack;
    }

    /**
     *
     * @return the $callLogVoiceMail
     */
    public function getCallLogVoiceMail()
    {
        return $this->callLogVoiceMail;
    }

    /**
     *
     * @return the $callLogUrgent
     */
    public function getCallLogUrgent()
    {
        return $this->callLogUrgent;
    }

    /**
     *
     * @return the $callLogRead
     */
    public function getCallLogRead()
    {
        return $this->callLogRead;
    }

    /**
     *
     * @return the $callLogCreatedBy
     */
    public function getCallLogCreatedBy()
    {
        return $this->callLogCreatedBy;
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
     * @return the $authEntity
     */
    public function getAuthEntity()
    {
        return $this->authEntity;
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
     * @param number $callLogId            
     */
    public function setCallLogId($callLogId)
    {
        $this->callLogId = $callLogId;
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
     * @param number $employeeId            
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
    }

    /**
     *
     * @param number $callLogTime            
     */
    public function setCallLogTime($callLogTime)
    {
        $this->callLogTime = $callLogTime;
    }

    /**
     *
     * @param string $callLogDetail            
     */
    public function setCallLogDetail($callLogDetail)
    {
        $this->callLogDetail = $callLogDetail;
    }

    /**
     *
     * @param boolean $callLogRequireCallBack            
     */
    public function setCallLogRequireCallBack($callLogRequireCallBack)
    {
        $this->callLogRequireCallBack = $callLogRequireCallBack;
    }

    /**
     *
     * @param boolean $callLogWillCallBack            
     */
    public function setCallLogWillCallBack($callLogWillCallBack)
    {
        $this->callLogWillCallBack = $callLogWillCallBack;
    }

    /**
     *
     * @param boolean $callLogVoiceMail            
     */
    public function setCallLogVoiceMail($callLogVoiceMail)
    {
        $this->callLogVoiceMail = $callLogVoiceMail;
    }

    /**
     *
     * @param boolean $callLogUrgent            
     */
    public function setCallLogUrgent($callLogUrgent)
    {
        $this->callLogUrgent = $callLogUrgent;
    }

    /**
     *
     * @param boolean $callLogRead            
     */
    public function setCallLogRead($callLogRead)
    {
        $this->callLogRead = $callLogRead;
    }

    /**
     *
     * @param number $callLogCreatedBy            
     */
    public function setCallLogCreatedBy($callLogCreatedBy)
    {
        $this->callLogCreatedBy = $callLogCreatedBy;
    }

    /**
     *
     * @param \Employee\Entity\EmployeeEntity $employeeEntity            
     */
    public function setEmployeeEntity($employeeEntity)
    {
        $this->employeeEntity = $employeeEntity;
    }

    /**
     *
     * @param \Auth\Entity\AuthEntity $authEntity            
     */
    public function setAuthEntity($authEntity)
    {
        $this->authEntity = $authEntity;
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