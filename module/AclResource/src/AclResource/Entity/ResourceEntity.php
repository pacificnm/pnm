<?php
namespace AclResource\Entity;

class ResourceEntity
{

    /**
     *
     * @var number
     */
    protected $aclResourceId;

    /**
     *
     * @var string
     */
    protected $aclResource;

    /**
     *
     * @return the $aclResourceId
     */
    public function getAclResourceId()
    {
        return $this->aclResourceId;
    }

    /**
     *
     * @return the $aclResource
     */
    public function getAclResource()
    {
        return $this->aclResource;
    }

    /**
     *
     * @param number $aclResourceId            
     */
    public function setAclResourceId($aclResourceId)
    {
        $this->aclResourceId = $aclResourceId;
    }

    /**
     *
     * @param string $aclResource            
     */
    public function setAclResource($aclResource)
    {
        $this->aclResource = $aclResource;
    }
}