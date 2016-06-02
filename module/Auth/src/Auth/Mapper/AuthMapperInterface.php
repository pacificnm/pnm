<?php
namespace Auth\Mapper;

use Auth\Entity\AuthEntity;

interface AuthMapperInterface
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
     * @param AuthEntity $entity            
     * @return AuthEntity
     */
    public function save(AuthEntity $entity);

    /**
     *
     * @param AuthEntity $entity            
     * @return boolean
     */
    public function delete(AuthEntity $entity);
}