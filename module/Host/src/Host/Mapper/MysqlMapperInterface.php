<?php
namespace Host\Mapper;

use Host\Entity\HostEntity;

interface MysqlMapperInterface
{
    /**
     *
     * @param array $filter
     * @return HostEntity
     */
    public function getAll($filter);
    
    /**
     *
     * @param number $id
     * @return HostEntity
     */
    public function get($id);
    
    /**
     *
     * @param number $clientId
     * @param number $workorderId
     * @return HostEntity
     */
    public function getClientHostNotInWorkorder($clientId, $workorderId);
    
    /**
     * 
     * @param number $clientId
     * @return HostEntity
     */
    public function getClientHosts($clientId);
    
    /**
     *
     * @param HostEntity $entity
     * @return HostEntity
     */
    public function save(HostEntity $entity);
    
    /**
     *
     * @param HostEntity $entity
     * @return boolean
     */
    public function delete(HostEntity $entity);
}

?>