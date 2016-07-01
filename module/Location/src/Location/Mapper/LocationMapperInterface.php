<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Location\Mapper;

use Location\Entity\LocationEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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