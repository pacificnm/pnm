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
     * @param number $userId            
     */
    public function setUserId($userId);

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
}