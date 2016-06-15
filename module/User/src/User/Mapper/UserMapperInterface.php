<?php
namespace User\Mapper;

use User\Entity\UserEntity;

interface UserMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return UserEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return UserEntity
     */
    public function get($id);

    /**
     * 
     * @param number $locationId
     * @return UserEntity
     */
    public function getPrimaryUserByLocation($locationId);
    
    /**
     * 
     * @param number $clientId
     * @return UserEntity
     */
    public function getClientPrimaryUser($clientId);
    
    /**
     *
     * @param UserEntity $entity            
     * @return UserEntity
     */
    public function save(UserEntity $entity);

    /**
     *
     * @param UserEntity $entity            
     * @return boolean
     */
    public function delete(UserEntity $entity);
}