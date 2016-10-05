<?php
namespace EmployeeEmail\Service;

use EmployeeEmail\Entity\EmployeeEmailEntity;
use EmployeeEmail\Mapper\EmployeeEmailMapperInterface;

class EmployeeEmailService implements EmployeeEmailServiceInterface
{

    /**
     *
     * @var EmployeeEmailMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param EmployeeEmailMapperInterface $mapper            
     */
    public function __construct(EmployeeEmailMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \EmployeeEmail\Service\EmployeeEmailServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \EmployeeEmail\Service\EmployeeEmailServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \EmployeeEmail\Service\EmployeeEmailServiceInterface::save()
     */
    public function save(EmployeeEmailEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \EmployeeEmail\Service\EmployeeEmailServiceInterface::delete()
     */
    public function delete(EmployeeEmailEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}