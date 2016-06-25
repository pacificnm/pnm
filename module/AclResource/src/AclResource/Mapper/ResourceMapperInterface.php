<?php
namespace AclResource\Mapper;

use AclResource\Entity\ResourceEntity;

interface ResourceMapperInterface
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