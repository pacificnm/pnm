<?php
namespace Auth\Entity;

use Employee\Entity\EmployeeEntity;
use User\Entity\UserEntity;

class AuthEntity
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
    protected $user;

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
     * @var string
     */
    protected $accessToken;

    /**
     *
     * @var string
     */
    protected $refreshToken;

    /**
     * 
     * @var number
     */
    protected $expiresIn;
    /**
     * @return the $authId
     */
    public function getAuthId()
    {
        return $this->authId;
    }

    /**
     * @return the $authRole
     */
    public function getAuthRole()
    {
        return $this->authRole;
    }

    /**
     * @return the $authEmail
     */
    public function getAuthEmail()
    {
        return $this->authEmail;
    }

    /**
     * @return the $authPassword
     */
    public function getAuthPassword()
    {
        return $this->authPassword;
    }

    /**
     * @return the $authName
     */
    public function getAuthName()
    {
        return $this->authName;
    }

    /**
     * @return the $authType
     */
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     * @return the $authLastLogin
     */
    public function getAuthLastLogin()
    {
        return $this->authLastLogin;
    }

    /**
     * @return the $authLastIp
     */
    public function getAuthLastIp()
    {
        return $this->authLastIp;
    }

    /**
     * @return the $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return the $employeeId
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     * @return the $userEntity
     */
    public function getUserEntity()
    {
        return $this->userEntity;
    }

    /**
     * @return the $employeeEntity
     */
    public function getEmployeeEntity()
    {
        return $this->employeeEntity;
    }

    /**
     * @return the $accessToken
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return the $refreshToken
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @return the $expiresIn
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param number $authId
     */
    public function setAuthId($authId)
    {
        $this->authId = $authId;
    }

    /**
     * @param string $authRole
     */
    public function setAuthRole($authRole)
    {
        $this->authRole = $authRole;
    }

    /**
     * @param string $authEmail
     */
    public function setAuthEmail($authEmail)
    {
        $this->authEmail = $authEmail;
    }

    /**
     * @param string $authPassword
     */
    public function setAuthPassword($authPassword)
    {
        $this->authPassword = $authPassword;
    }

    /**
     * @param string $authName
     */
    public function setAuthName($authName)
    {
        $this->authName = $authName;
    }

    /**
     * @param string $authType
     */
    public function setAuthType($authType)
    {
        $this->authType = $authType;
    }

    /**
     * @param string $authLastLogin
     */
    public function setAuthLastLogin($authLastLogin)
    {
        $this->authLastLogin = $authLastLogin;
    }

    /**
     * @param string $authLastIp
     */
    public function setAuthLastIp($authLastIp)
    {
        $this->authLastIp = $authLastIp;
    }

    /**
     * @param number $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param number $employeeId
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
    }

    /**
     * @param \User\Entity\UserEntity $userEntity
     */
    public function setUserEntity($userEntity)
    {
        $this->userEntity = $userEntity;
    }

    /**
     * @param \Employee\Entity\EmployeeEntity $employeeEntity
     */
    public function setEmployeeEntity($employeeEntity)
    {
        $this->employeeEntity = $employeeEntity;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param string $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @param number $expiresIn
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
    }

}
