<?php
namespace PanoramaHost\Service;

use PanoramaHost\Entity\PanoramaHostEntity;

interface PanoramaHostServiceInterface
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
     * @param number $hostId
     * @param number $panoramaDeviceId
     */
    public function createPanoramaHost($hostId, $panoramaDeviceId);
    
    /**
     *
     * @param PanoramaHostEntity $entity            
     * @return bool
     */
    public function delete(PanoramaHostEntity $entity);
}