<?php
namespace Phone\Entity;

class PhoneEntity
{

    /**
     *
     * @var nuber
     */
    protected $phoneId;

    /**
     *
     * @var string
     */
    protected $phoneType;

    /**
     *
     * @var string
     */
    protected $phoneNum;

    /**
     *
     * @return the $phoneId
     */
    public function getPhoneId()
    {
        return $this->phoneId;
    }

    /**
     *
     * @return the $phoneType
     */
    public function getPhoneType()
    {
        return $this->phoneType;
    }

    /**
     *
     * @return the $phoneNum
     */
    public function getPhoneNum()
    {
        return $this->phoneNum;
    }

    /**
     *
     * @param \Phone\Entity\nuber $phoneId            
     */
    public function setPhoneId($phoneId)
    {
        $this->phoneId = $phoneId;
    }

    /**
     *
     * @param string $phoneType            
     */
    public function setPhoneType($phoneType)
    {
        $this->phoneType = $phoneType;
    }

    /**
     *
     * @param string $phoneNum            
     */
    public function setPhoneNum($phoneNum)
    {
        $this->phoneNum = $phoneNum;
    }
}