<?php
namespace Location\Mapper;

use Location\Entity\LocationEntity;

interface LocationMapperInterface
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
     * @param string $locationType
     * @return LocationEntity
     */
    public function getClientLocationByType($clientId, $locationType);
    
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
}