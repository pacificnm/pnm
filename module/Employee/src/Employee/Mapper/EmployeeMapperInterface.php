<?php
namespace Employee\Mapper;

use Employee\Entity\EmployeeEntity;

interface EmployeeMapperInterface
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
     * @param EmployeeEntity $employeeEntity            
     * @return EmployeeEntity
     */
    public function save(EmployeeEntity $employeeEntity);

    /**
     *
     * @param EmployeeEntity $employeeEntity            
     * @return boolean
     */
    public function delete(EmployeeEntity $employeeEntity);
}