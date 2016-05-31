<?php
namespace Password\Entity;

interface PasswordEntityInterface
{

    /**
     *
     * @return the $passwordId
     */
    public function getPasswordId();

    /**
     *
     * @return the $clientId
     */
    public function getClientId();

    /**
     *
     * @return the $passwordLocation
     */
    public function getPasswordLocation();

    /**
     *
     * @return the $passwordTitle
     */
    public function getPasswordTitle();

    /**
     *
     * @return the $passwordUsername
     */
    public function getPasswordUsername();

    /**
     *
     * @return the $passwordPassword
     */
    public function getPasswordPassword();

    /**
     *
     * @param number $passwordId            
     */
    public function setPasswordId($passwordId);

    /**
     *
     * @param number $clientId            
     */
    public function setClientId($clientId);

    /**
     *
     * @param string $passwordLocation            
     */
    public function setPasswordLocation($passwordLocation);

    /**
     *
     * @param string $passwordTitle            
     */
    public function setPasswordTitle($passwordTitle);

    /**
     *
     * @param string $passwordUsername            
     */
    public function setPasswordUsername($passwordUsername);

    /**
     *
     * @param string $passwordPassword            
     */
    public function setPasswordPassword($passwordPassword);
}