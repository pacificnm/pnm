<?php
namespace Password\Service;

use Password\Entity\PasswordEntity;

interface PasswordServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return PasswordEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PasswordEntity
     */
    public function get($id);

    /**
     *
     * @param PasswordEntity $entity            
     * @return PasswordEntity
     */
    public function save(PasswordEntity $entity);

    /**
     *
     * @param PasswordEntity $entity            
     * @return boolean
     */
    public function delete(PasswordEntity $entity);
}