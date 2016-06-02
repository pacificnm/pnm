<?php
namespace Phone\Mapper;

use Phone\Entity\PhoneEntity;

interface PhoneMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return PhoneEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PhoneEntity
     */
    public function get($id);

    /**
     *
     * @param number $locationId            
     * @return PhoneEntity
     */
    public function getPrimaryPhoneByLocation($locationId);

    /**
     *
     * @param PhoneEntity $entity            
     * @return PhoneEntity
     */
    public function save(PhoneEntity $entity);

    /**
     *
     * @param PhoneEntity $entity            
     * @return boolean
     */
    public function delete(PhoneEntity $entity);
}