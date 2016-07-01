<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Location\Service;

use Location\Entity\LocationEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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
    
    /**
     *
     * @param number $clientId
     * @return boolean
     */
    public function clientHasPrimaryLocation($clientId);
    
    /**
     *
     * @param number $clientId
     * @param string $locationType
     * @return LocationEntity
     */
    public function getClientLocationByType($clientId, $locationType);
}
