<?php
namespace Host\Service;

use Host\Entity\HostEntity;

interface HostServiceInterface
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
     * @param unknown $clientId
     * @param unknown $hostDescription
     * @param unknown $hostHealth
     * @param unknown $hostIp
     * @param unknown $hostName
     * @param unknown $hostStatus
     * @param unknown $hostTypeId
     * @param unknown $locationId
     */
    public function create($clientId, $hostDescription, $hostHealth, $hostIp, $hostName, $hostStatus, $hostTypeId, $locationId);

    /**
     *
     * @param HostEntity $entity            
     * @return boolean
     */
    public function delete(HostEntity $entity);
}