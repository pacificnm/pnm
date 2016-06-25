<?php
namespace AclRole\Service;

use AclRole\Entity\RoleEntity;

interface RoleServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return RoleEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return RoleEntity
     */
    public function get($id);

    /**
     *
     * @param string $role            
     * @return RoleEntity
     */
    public function getRole($role);

    /**
     *
     * @param RoleEntity $entity            
     * @return RoleEntity
     */
    public function save(RoleEntity $entity);

    /**
     *
     * @param RoleEntity $entity            
     * @return boolean
     */
    public function delete(RoleEntity $entity);
}