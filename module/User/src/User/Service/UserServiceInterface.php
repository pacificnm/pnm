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
     * @param UserEntity $userEntity
     * @return UserEntity
     */
    public function save(UserEntity $userEntity);
    
    /**
     *
     * @param UserEntity $userEntity
     * @return boolean
     */
    public function delete(UserEntity $userEntity);
}