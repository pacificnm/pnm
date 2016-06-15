<?php
namespace Location\Service;

use Location\Entity\LocationEntity;

interface LocationServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return LocationEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return LocationEntity
     */
    public function get($id);

    /**
     * 
     * @param number $clientId
     * @return LocationEntity
     */
    public function getClientBillingLocation($clientId);
    
    /**
     *
     * @param LocationEntity $entity            
     * @return LocationEntity
     */
    public function save(LocationEntity $entity);

    /**
     *
     * @param LocationEntity $entity            
     * @return boolean
     */
    public function delete(LocationEntity $entity);
    
    /**
     * 
     * @param number $clientId
     * @return LocationEntity
     */
    public function getClientLocations($clientId);
}
