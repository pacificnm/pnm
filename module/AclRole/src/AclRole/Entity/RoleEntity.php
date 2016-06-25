<?php
namespace AclRole\Entity;

class RoleEntity
{

    /**
     *
     * @var number
     */
    protected $aclRoleId;

    /**
     *
     * @var string
     */
    protected $aclRole;

    /**
     *
     * @return the $aclRoleId
     */
    public function getAclRoleId()
    {
        return $this->aclRoleId;
    }

    /**
     *
     * @return the $aclRole
     */
    public function getAclRole()
    {
        return $this->aclRole;
    }

    /**
     *
     * @param number $aclRoleId            
     */
    public function setAclRoleId($aclRoleId)
    {
        $this->aclRoleId = $aclRoleId;
    }

    /**
     *
     * @param string $aclRole            
     */
    public function setAclRole($aclRole)
    {
        $this->aclRole = $aclRole;
    }
}