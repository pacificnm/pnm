<?php
namespace Password\Entity;

class PasswordEntity implements PasswordEntityInterface
{

    /**
     *
     * @var number
     */
    protected $passwordId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var string
     */
    protected $passwordLocation;

    /**
     *
     * @var string
     */
    protected $passwordTitle;

    /**
     *
     * @var string
     */
    protected $passwordUsername;

    /**
     *
     * @var string
     */
    protected $passwordPassword;

    /**
     *
     * @return the $passwordId
     */
    public function getPasswordId()
    {
        return $this->passwordId;
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
     * @return the $passwordLocation
     */
    public function getPasswordLocation()
    {
        return $this->passwordLocation;
    }

    /**
     *
     * @return the $passwordTitle
     */
    public function getPasswordTitle()
    {
        return $this->passwordTitle;
    }

    /**
     *
     * @return the $passwordUsername
     */
    public function getPasswordUsername()
    {
        return $this->passwordUsername;
    }

    /**
     *
     * @return the $passwordPassword
     */
    public function getPasswordPassword()
    {
        return $this->passwordPassword;
    }

    /**
     *
     * @param number $passwordId            
     */
    public function setPasswordId($passwordId)
    {
        $this->passwordId = $passwordId;
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
     * @param string $passwordLocation            
     */
    public function setPasswordLocation($passwordLocation)
    {
        $this->passwordLocation = $passwordLocation;
    }

    /**
     *
     * @param string $passwordTitle            
     */
    public function setPasswordTitle($passwordTitle)
    {
        $this->passwordTitle = $passwordTitle;
    }

    /**
     *
     * @param string $passwordUsername            
     */
    public function setPasswordUsername($passwordUsername)
    {
        $this->passwordUsername = $passwordUsername;
    }

    /**
     *
     * @param string $passwordPassword            
     */
    public function setPasswordPassword($passwordPassword)
    {
        $this->passwordPassword = $passwordPassword;
    }
}