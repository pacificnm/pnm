<?php
namespace Employee\Service;

use Employee\Entity\EmployeeEntity;

interface EmployeeServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return EmployeeEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return EmployeeEntity
     */
    public function get($id);

    /**
     *
     * @param EmployeeEntity $entity            
     * @return EmployeeEntity
     */
    public function save(EmployeeEntity $entity);

    /**
     *
     * @param EmployeeEntity $entity            
     * @return boolean
     */
    public function delete(EmployeeEntity $entity);
}