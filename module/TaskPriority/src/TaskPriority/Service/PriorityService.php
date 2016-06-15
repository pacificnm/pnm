<?php
namespace TaskPriority\Service;

use TaskPriority\Entity\PriorityEntity;
use TaskPriority\Mapper\PriorityMapperInterface;

class PriorityService implements PriorityServiceInterface
{

    /**
     *
     * @var PriorityMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param PriorityMapperInterface $mapper            
     */
    public function __construct(PriorityMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TaskPriority\Service\PriorityServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TaskPriority\Service\PriorityServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TaskPriority\Service\PriorityServiceInterface::save()
     */
    public function save(PriorityEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TaskPriority\Service\PriorityServiceInterface::delete()
     */
    public function delete(PriorityEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}
