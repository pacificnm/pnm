<?php
namespace Email\Entity;

use Auth\Entity\AuthEntity;
use Client\Entity\ClientEntity;

class EmailEntity
{

    /**
     *
     * @var number
     */
    protected $emailId;

    /**
     *
     * @var number
     */
    protected $emailDateCreated;

    /**
     *
     * @var number
     */
    protected $emailDateSent;

    /**
     *
     * @var string
     */
    protected $emailToAddress;

    /**
     *
     * @var string
     */
    protected $emailToName;

    /**
     *
     * @var string
     */
    protected $emailFromAddress;

    /**
     *
     * @var string
     */
    protected $emailFromName;

    /**
     *
     * @var string
     */
    protected $emailSubject;

    /**
     *
     * @var string
     */
    protected $emailBody;

    /**
     *
     * @var string
     */
    protected $emailLog;

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
     * @return the $emailId
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     *
     * @return the $emailDateCreated
     */
    public function getEmailDateCreated()
    {
        return $this->emailDateCreated;
    }

    /**
     *
     * @return the $emailDateSent
     */
    public function getEmailDateSent()
    {
        return $this->emailDateSent;
    }

    /**
     *
     * @return the $emailToAddress
     */
    public function getEmailToAddress()
    {
        return $this->emailToAddress;
    }

    /**
     *
     * @return the $emailToName
     */
    public function getEmailToName()
    {
        return $this->emailToName;
    }

    /**
     *
     * @return the $emailFromAddress
     */
    public function getEmailFromAddress()
    {
        return $this->emailFromAddress;
    }

    /**
     *
     * @return the $emailFromName
     */
    public function getEmailFromName()
    {
        return $this->emailFromName;
    }

    /**
     *
     * @return the $emailSubject
     */
    public function getEmailSubject()
    {
        return $this->emailSubject;
    }

    /**
     *
     * @return the $emailBody
     */
    public function getEmailBody()
    {
        return $this->emailBody;
    }

    /**
     *
     * @return the $emailLog
     */
    public function getEmailLog()
    {
        return $this->emailLog;
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
     * @param number $emailId            
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;
    }

    /**
     *
     * @param number $emailDateCreated            
     */
    public function setEmailDateCreated($emailDateCreated)
    {
        $this->emailDateCreated = $emailDateCreated;
    }

    /**
     *
     * @param number $emailDateSent            
     */
    public function setEmailDateSent($emailDateSent)
    {
        $this->emailDateSent = $emailDateSent;
    }

    /**
     *
     * @param string $emailToAddress            
     */
    public function setEmailToAddress($emailToAddress)
    {
        $this->emailToAddress = $emailToAddress;
    }

    /**
     *
     * @param string $emailToName            
     */
    public function setEmailToName($emailToName)
    {
        $this->emailToName = $emailToName;
    }

    /**
     *
     * @param string $emailFromAddress            
     */
    public function setEmailFromAddress($emailFromAddress)
    {
        $this->emailFromAddress = $emailFromAddress;
    }

    /**
     *
     * @param string $emailFromName            
     */
    public function setEmailFromName($emailFromName)
    {
        $this->emailFromName = $emailFromName;
    }

    /**
     *
     * @param string $emailSubject            
     */
    public function setEmailSubject($emailSubject)
    {
        $this->emailSubject = $emailSubject;
    }

    /**
     *
     * @param string $emailBody            
     */
    public function setEmailBody($emailBody)
    {
        $this->emailBody = $emailBody;
    }

    /**
     *
     * @param string $emailLog            
     */
    public function setEmailLog($emailLog)
    {
        $this->emailLog = $emailLog;
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