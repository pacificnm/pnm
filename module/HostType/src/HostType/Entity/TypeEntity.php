<?php
namespace HostType\Entity;

class TypeEntity
{

    /**
     *
     * @var number
     */
    protected $hostTypeId;

    /**
     *
     * @var string
     */
    protected $hostTypeName;

    /**
     *
     * @return the $hostTypeId
     */
    public function getHostTypeId()
    {
        return $this->hostTypeId;
    }

    /**
     *
     * @return the $hostTypeName
     */
    public function getHostTypeName()
    {
        return $this->hostTypeName;
    }

    /**
     *
     * @param number $hostTypeId            
     */
    public function setHostTypeId($hostTypeId)
    {
        $this->hostTypeId = $hostTypeId;
    }

    /**
     *
     * @param string $hostTypeName            
     */
    public function setHostTypeName($hostTypeName)
    {
        $this->hostTypeName = $hostTypeName;
    }
}