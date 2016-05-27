<?php
namespace Employee\Service;

use Employee\Entity\EmployeeEntity;
use Employee\Mapper\EmployeeMapperInterface;

class EmployeeService implements EmployeeServiceInterface
{
    /**
     * 
     * @var EmployeeMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param EmployeeMapperInterface $mapper
     */
    public function __construct(EmployeeMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Employee\Service\EmployeeServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Employee\Service\EmployeeServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Employee\Service\EmployeeServiceInterface::save()
     */
    public function save(EmployeeEntity $employeeEntity)
    {
        return $this->mapper->save($employeeEntity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Employee\Service\EmployeeServiceInterface::delete()
     */
    public function delete(EmployeeEntity $employeeEntity)
    {
        return $this->mapper->delete($employeeEntity);
    }
}