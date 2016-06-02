<?php
namespace User\Service;

use User\Entity\UserEntity;

interface UserServiceInterface
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