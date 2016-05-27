<?php
namespace Auth\Service;

use Auth\Entity\AuthEntity;

interface AuthServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return AuthEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return AuthEntity
     */
    public function get($id);

    /**
     *
     * @param string $authEmail            
     * @param string $authPassword            
     */
    public function getAuth($authEmail, $authPassword);

    /**
     * 
     * @param string $authEmail
     * @return AuthEntity
     */
    public function getAuthByEmail($authEmail);
    
    /**
     *
     * @param AuthEntity $authEntity            
     * @return AuthEntity
     */
    public function save(AuthEntity $authEntity);

    /**
     *
     * @param AuthEntity $authEntity            
     * @return boolean
     */
    public function delete(AuthEntity $authEntity);
}