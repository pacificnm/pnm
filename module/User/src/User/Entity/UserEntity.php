<?php
namespace User\Entity;

class UserEntity implements UserEntityInterface
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
    protected $userStatus;

    /**
     *
     * @var string
     */
    protected $userNameFirst;

    /**
     *
     * @var string
     */
    protected $userNameLast;

    /**
     *
     * @var string
     */
    protected $userJobTitle;

    /**
     *
     * @var string
     */
    protected $userEmail;

    /**
     *
     * @var string
     */
    protected $userType;

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
     * @return the $userStatus
     */
    public function getUserStatus()
    {
        return $this->userStatus;
    }

    /**
     *
     * @return the $userNameFirst
     */
    public function getUserNameFirst()
    {
        return $this->userNameFirst;
    }

    /**
     *
     * @return the $userNameLast
     */
    public function getUserNameLast()
    {
        return $this->userNameLast;
    }

    /**
     *
     * @return the $userJobTitle
     */
    public function getUserJobTitle()
    {
        return $this->userJobTitle;
    }

    /**
     *
     * @return the $userEmail
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     *
     * @return the $userType
     */
    public function getUserType()
    {
        return $this->userType;
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
     * @param string $userStatus            
     */
    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;
    }

    /**
     *
     * @param string $userNameFirst            
     */
    public function setUserNameFirst($userNameFirst)
    {
        $this->userNameFirst = $userNameFirst;
    }

    /**
     *
     * @param string $userNameLast            
     */
    public function setUserNameLast($userNameLast)
    {
        $this->userNameLast = $userNameLast;
    }

    /**
     *
     * @param string $userJobTitle            
     */
    public function setUserJobTitle($userJobTitle)
    {
        $this->userJobTitle = $userJobTitle;
    }

    /**
     *
     * @param string $userEmail            
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    /**
     *
     * @param string $userType            
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
    }
}

?>