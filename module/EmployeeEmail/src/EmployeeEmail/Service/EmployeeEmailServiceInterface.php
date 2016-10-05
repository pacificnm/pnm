<?php
namespace EmployeeEmail\Service;

use EmployeeEmail\Entity\EmployeeEmailEntity;

interface EmployeeEmailServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return EmployeeEmailEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return EmployeeEmailEntity
     */
    public function get($id);

    /**
     *
     * @param EmployeeEmailEntity $entity            
     * @return EmployeeEmailEntity
     */
    public function save(EmployeeEmailEntity $entity);

    /**
     *
     * @param EmployeeEmailEntity $entity            
     * @return EmployeeEmailEntity
     */
    public function delete(EmployeeEmailEntity $entity);
}