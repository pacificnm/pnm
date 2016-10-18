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
    protected $lastUse;

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
     * @return the $lastUse
     */
    public function getLastUse()
    {
        return $this->lastUse;
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
     * @param string $lastUse            
     */
    public function setLastUse($lastUse)
    {
        $this->lastUse = $lastUse;
    }
}