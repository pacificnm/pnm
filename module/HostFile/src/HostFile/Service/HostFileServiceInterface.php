<?php
namespace HostFile\Service;

use HostFile\Entity\HostFileEntity;

interface HostFileServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return HostFileEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return HostFileEntity
     */
    public function get($id);

    /**
     *
     * @param HostFileEntity $entity            
     * @return HostFileEntity
     */
    public function save(HostFileEntity $entity);

    /**
     *
     * @param HostFileEntity $entity            
     * @return boolean
     */
    public function delete(HostFileEntity $entity);

    /**
     *
     * @param number $hostId            
     * @return HostFileEntity
     */
    public function getHostFiles($hostId);

    /**
     *
     * @param number $fileId            
     * @param number $hostId            
     * @return HostFileEntity
     */
    public function createHostFile($fileId, $hostId);

    /**
     *
     * @param number $fileId            
     * @return boolean
     */
    public function deleteHostFile($fileId);
}