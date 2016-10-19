<?php
namespace PanoramaHost\Mapper;

use PanoramaHost\Entity\PanoramaHostEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return PanoramaHostEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PanoramaHostEntity
     */
    public function get($id);

    /**
     *
     * @param unknown $deviceId            
     * @return PanoramaHostEntity
     */
    public function getByDeviceId($deviceId);

    /**
     *
     * @param number $hostId            
     * @return PanoramaHostEntity
     */
    public function getByHostId($hostId);

    /**
     *
     * @param PanoramaHostEntity $entity            
     * @return PanoramaHostEntity
     */
    public function save(PanoramaHostEntity $entity);

    /**
     *
     * @param PanoramaHostEntity $entity            
     * @return bool
     */
    public function delete(PanoramaHostEntity $entity);
}