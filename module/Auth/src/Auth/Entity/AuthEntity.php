<?php
namespace Auth\Entity;

use Employee\Entity\EmployeeEntity;
use User\Entity\UserEntity;

class AuthEntity implements AuthEntityInterface
{

    /**
     *
     * @var number
     */
    protected $authId;

    /**
     *
     * @var string
     */
    protected $authRole;

    /**
     *
     * @var string
     */
    protected $authEmail;

    /**
     *
     * @var string
     */
    protected $authPassword;

    /**
     *
     * @var string
     */
    protected $authName;

    /**
     *
     * @var string
     */
    protected $authType;

    /**
     *
     * @var string
     */
    protected $authLastLogin;

    /**
     *
     * @var string
     */
    protected $authLastIp;

    /**
     *
     * @var number
     */
    protected $userId;

    /**
     *
     * @var number
     */
    protected $employeeId;

    /**
     *
     * @var UserEntity
     */
    protected $userEntity;

    /**
     *
     * @var EmployeeEntity
     */
    protected $employeeEntity;

    /**
     *
     * @return the $authId
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     *
     * @return the $authRole
     */
    public function getAuthRole()
    {
        return $this->authRole;
    }

    /**
     *
     * @return the $authEmail
     */
    public function getAuthEmail()
    {
        return $this->authEmail;
    }

    /**
     *
     * @return the $authPassword
     */
    public function getAuthPassword()
    {
        return $this->authPassword;
    }

    /**
     *
     * @return the $authName
     */
    public function getAuthName()
    {
        return $this->authName;
    }

    /**
     *
     * @return the $authType
     */
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     *
     * @return the $authLastLogin
     */
    public function getAuthLastLogin()
    {
        return $this->authLastLogin;
    }

    /**
     *
     * @return the $authLastIp
     */
    public function getAuthLastIp()
    {
        return $this->authLastIp;
    }

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
     * @return the $employeeId
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     *
     * @return the $userEntity
     */
    public function getUserEntity()
    {
        return $this->userEntity;
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
     * @param number $authId            
     */
    public function setAuthId($authId)
    {
        $this->authId = $authId;
    }

    /**
     *
     * @param string $authRole            
     */
    public function setAuthRole($authRole)
    {
        $this->authRole = $authRole;
    }

    /**
     *
     * @param string $authEmail            
     */
    public function setAuthEmail($authEmail)
    {
        $this->authEmail = $authEmail;
    }

    /**
     *
     * @param string $authPassword            
     */
    public function setAuthPassword($authPassword)
    {
        $this->authPassword = $authPassword;
    }

    /**
     *
     * @param string $authName            
     */
    public function setAuthName($authName)
    {
        $this->authName = $authName;
    }

    /**
     *
     * @param string $authType            
     */
    public function setAuthType($authType)
    {
        $this->authType = $authType;
    }

    /**
     *
     * @param string $authLastLogin            
     */
    public function setAuthLastLogin($authLastLogin)
    {
        $this->authLastLogin = $authLastLogin;
    }

    /**
     *
     * @param string $authLastIp            
     */
    public function setAuthLastIp($authLastIp)
    {
        $this->authLastIp = $authLastIp;
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
     * @param number $employeeId            
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
    }

    /**
     *
     * @param \User\Entity\UserEntity $userEntity            
     */
    public function setUserEntity($userEntity)
    {
        $this->userEntity = $userEntity;
    }

    /**
     *
     * @param \Employee\Entity\EmployeeEntity $employeeEntity            
     */
    public function setEmployeeEntity($employeeEntity)
    {
        $this->employeeEntity = $employeeEntity;
    }
}
