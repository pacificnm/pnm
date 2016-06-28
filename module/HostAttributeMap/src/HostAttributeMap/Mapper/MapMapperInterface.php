<?php
namespace HostAttributeMap\Mapper;

use HostAttributeMap\Entity\MapEntity;

interface MapMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return MapEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return MapEntity
     */
    public function get($id);

    /**
     *
     * @param MapEntity $entity            
     * @return MapEntity
     */
    public function save(MapEntity $entity);

    /**
     *
     * @param MapEntity $entity            
     * @return boolean
     */
    public function delete(MapEntity $entity);
}