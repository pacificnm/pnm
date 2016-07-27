<?php
namespace WorkorderHost\Mapper;

use WorkorderHost\Entity\WorkorderHostEntity;

interface MysqlMapperInterface
{
    /**
     *
     * @param array $filter
     * @return WorkorderHostEntity
     */
    public function getAll($filter);
    
    /**
     *
     * @param number $id
     * @return WorkorderHostEntity
     */
    public function get($id);
    
    /**
     * 
     * @param number $workorderId
     * @return WorkorderHostEntity
     */
    public function getWorkorderHosts($workorderId);
    
    /**
     * 
     * @param number $clientId
     * @param number $workorderId
     * @return WorkorderHostEntity
     */
    public function getNotInWorkorderHosts($clientId, $workorderId);
    
    /**
     *
     * @param WorkorderHostEntity $entity
     * @return WorkorderHostEntity
     */
    public function save(WorkorderHostEntity $entity);
    
    /**
     *
     * @param WorkorderHostEntity $entity
     * @return boolean
     */
    public function delete(WorkorderHostEntity $entity);
}

