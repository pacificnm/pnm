<?php
namespace PanoramaClient\Service;

use PanoramaClient\Entity\PanoramaClientEntity;

interface PanoramaClientServiceInterface
{

    /**
     *
     * @param unknown $filter            
     * @return PanoramaClientEntity
     */
    public function getAll($filter);

    /**
     *
     * @param unknown $id            
     * @return PanoramaClientEntity
     */
    public function get($id);

    /**
     *
     * @param unknown $cid            
     * @return PanoramaClientEntity
     */
    public function getByCid($cid);

    /**
     *
     * @param number $clientId
     * @return PanoramaClientEntity
     */
    public function getByClientId($clientId);
    
    /**
     *
     * @param PanoramaClientEntity $entity            
     * @return PanoramaClientEntity
     */
    public function save(PanoramaClientEntity $entity);

    /**
     *
     * @param number $clientId            
     * @param number $panoramaClientCid            
     * @return PanoramaClientEntity
     */
    public function create($clientId, $panoramaClientCid);

    /**
     *
     * @param PanoramaClientEntity $entity            
     * @return bool
     */
    public function delete(PanoramaClientEntity $entity);
}