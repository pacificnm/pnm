<?php
namespace User\Entity;

interface UserEntityInterface
{

    /**
     *
     * @return the $userId
     */
    public function getUserId();

    /**
     *
     * @return the $clientId
     */
    public function getClientId();

    /**
     *
     * @return the $locationId
     */
    public function getLocationId();

    /**
     *
     * @return the $userStatus
     */
    public function getUserStatus();

    /**
     *
     * @return the $userNameFirst
     */
    public function getUserNameFirst();

    /**
     *
     * @return the $userNameLast
     */
    public function getUserNameLast();

    /**
     *
     * @return the $userJobTitle
     */
    public function getUserJobTitle();

    /**
     *
     * @return the $userEmail
     */
    public function getUserEmail();

    /**
     *
     * @return the $userType
     */
    public function getUserType();

    /**
     *
     * @return the $clientEntity
     */
    public function getClientEntity();

    /**
     *
     * @return the $locationEntity
     */
    public function getLocationEntity();

    /**
     *
     * @param number $userId            
     */
    public function setUserId($userId);

    /**
     *
     * @param number $clientId            
     */
    public function setClientId($clientId);

    /**
     *
     * @param number $locationId            
     */
    public function setLocationId($locationId);

    /**
     *
     * @param string $userStatus            
     */
    public function setUserStatus($userStatus);

    /**
     *
     * @param string $userNameFirst            
     */
    public function setUserNameFirst($userNameFirst);

    /**
     *
     * @param string $userNameLast            
     */
    public function setUserNameLast($userNameLast);

    /**
     *
     * @param string $userJobTitle            
     */
    public function setUserJobTitle($userJobTitle);

    /**
     *
     * @param string $userEmail            
     */
    public function setUserEmail($userEmail);

    /**
     *
     * @param string $userType            
     */
    public function setUserType($userType);

    /**
     *
     * @param \Client\Entity\ClientEntity $clientEntity            
     */
    public function setClientEntity($clientEntity);

    /**
     *
     * @param \Location\Entity\LocationEntity $locationEntity            
     */
    public function setLocationEntity($locationEntity);
}