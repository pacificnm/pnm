<?php
namespace Panorama\Service;

use Panorama\Entity\UserEntity;

interface UserServiceInterface
{

    /**
     *
     * @param number $cid            
     * @param number $id            
     * @return UserEntity
     */
    public function getUser($cid, $id);

    /**
     *
     * @param number $cid            
     * @return UserEntity
     */
    public function getUsers($cid);
}