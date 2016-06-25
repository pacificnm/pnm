<?php
namespace AclResource\Service;

use AclResource\Entity\ResourceEntity;

interface ResourceServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return ResourceEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return ResourceEntity
     */
    public function get($id);

    /**
     * 
     * @param string $resource
     * @return ResourceEntity
     */
    public function getReource($resource);
    
    /**
     *
     * @param ResourceEntity $entity            
     * @return ResourceEntity
     */
    public function save(ResourceEntity $entity);

    /**
     *
     * @param ResourceEntity $entity            
     * @return boolean
     */
    public function delete(ResourceEntity $entity);
}