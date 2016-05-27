<?php
namespace Auth\Entity;

interface AuthEntityInterface
{
    /**
     * @return the $authId
     */
    public function getAuthId();
    
    /**
     * @return the $authEmail
     */
    public function getAuthEmail();
    
    /**
     * @return the $authPassword
     */
    public function getAuthPassword();
    
    /**
     * @return the $authName
     */
    public function getAuthName();
    
    /**
     * @return the $authType
     */
    public function getAuthType();
    
    /**
     * @return the $authLastLogin
     */
    public function getAuthLastLogin();
    
    /**
     * @return the $authLastIp
     */
    public function getAuthLastIp();
    
    /**
     * @return the $userId
     */
    public function getUserId();
    
    /**
     * @return the $employeeId
     */
    public function getEmployeeId();
    
    /**
     * @param number $authId
     */
    public function setAuthId($authId);
    
    /**
     * @param string $authEmail
     */
    public function setAuthEmail($authEmail);
    
    /**
     * @param string $authPassword
     */
    public function setAuthPassword($authPassword);
    
    /**
     * @param string $authName
     */
    public function setAuthName($authName);
    
    /**
     * @param string $authType
     */
    public function setAuthType($authType);
    
    /**
     * @param string $authLastLogin
     */
    public function setAuthLastLogin($authLastLogin);
    
    /**
     * @param string $authLastIp
     */
    public function setAuthLastIp($authLastIp);
    
    /**
     * @param number $userId
     */
    public function setUserId($userId);
    
    /**
     * @param number $employeeId
     */
    public function setEmployeeId($employeeId);
}