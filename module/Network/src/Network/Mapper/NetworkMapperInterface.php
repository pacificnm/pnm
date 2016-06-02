<?php
namespace Network\Mapper;

use Network\Entity\NetworkEntity;

interface NetworkMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return NetworkEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return NetworkEntity
     */
    public function get($id);

    /**
     *
     * @param NetworkEntity $entity            
     * @return NetworkEntity
     */
    public function save(NetworkEntity $entity);

    /**
     *
     * @param NetworkEntity $entity            
     * @return NetworkEntity
     */
    public function delete(NetworkEntity $entity);
}