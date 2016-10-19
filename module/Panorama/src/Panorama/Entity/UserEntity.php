<?php
namespace Panorama\Entity;

class UserEntity
{

    /**
     *
     * @var number
     */
    protected $userId;

    /**
     *
     * @var string
     */
    protected $username;

    /**
     *
     * @var string
     */
    protected $fullName;

    /**
     *
     * @var EmailAddressesEntity
     */
    protected $emailAddressesEntity;

    /**
     *
     * @var string
     */
    protected $firstSeen;

    /**
     *
     * @var string
     */
    protected $lastSeen;

    /**
     *
     * @var string
     */
    protected $lastDeviceId;

    /**
     *
     * @return the $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     *
     * @return the $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     *
     * @return the $fullName
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     *
     * @return the $emailAddressesEntity
     */
    public function getEmailAddressesEntity()
    {
        return $this->emailAddressesEntity;
    }

    /**
     *
     * @return the $firstSeen
     */
    public function getFirstSeen()
    {
        return $this->firstSeen;
    }

    /**
     *
     * @return the $lastSeen
     */
    public function getLastSeen()
    {
        return $this->lastSeen;
    }

    /**
     *
     * @return the $lastDeviceId
     */
    public function getLastDeviceId()
    {
        return $this->lastDeviceId;
    }

    /**
     *
     * @param number $userId            
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     *
     * @param string $username            
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     *
     * @param string $fullName            
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     *
     * @param \Panorama\Entity\EmailAddressesEntity $emailAddressesEntity            
     */
    public function setEmailAddressesEntity($emailAddressesEntity)
    {
        $this->emailAddressesEntity = $emailAddressesEntity;
    }

    /**
     *
     * @param string $firstSeen            
     */
    public function setFirstSeen($firstSeen)
    {
        $this->firstSeen = $firstSeen;
    }

    /**
     *
     * @param string $lastSeen            
     */
    public function setLastSeen($lastSeen)
    {
        $this->lastSeen = $lastSeen;
    }

    /**
     *
     * @param string $lastDeviceId            
     */
    public function setLastDeviceId($lastDeviceId)
    {
        $this->lastDeviceId = $lastDeviceId;
    }
}