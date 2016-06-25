<?php
namespace Acl\Service;

use Acl\Entity\AclEntity;

interface AclServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return AclEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return AclEntity
     */
    public function get($id);

    /**
     *
     * @param string $role            
     * @param string $resource            
     * @return AclEntity
     */
    public function getAclRule($role, $resource);

    /**
     *
     * @param AclEntity $entity            
     * @return AclEntity
     */
    public function save(AclEntity $entity);

    /**
     *
     * @param AclEntity $entity            
     * @return boolean
     */
    public function delete(AclEntity $entity);
}