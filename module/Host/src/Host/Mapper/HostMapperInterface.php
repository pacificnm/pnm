<?php
namespace Host\Mapper;

use Host\Entity\HostEntity;

interface HostMapperInterface
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
