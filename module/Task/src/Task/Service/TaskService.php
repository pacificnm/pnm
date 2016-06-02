<?php
namespace Task\Service;

use Task\Entity\TaskEntity;
use Task\Mapper\TaskMapperInterface;

class TaskService implements TaskServiceInterface
{

    /**
     *
     * @var TaskMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param TaskMapperInterface $mapper            
     */
    public function __construct(TaskMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Task\Service\TaskServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Task\Service\TaskServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Task\Service\TaskServiceInterface::save()
     */
    public function save(TaskEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Task\Service\TaskServiceInterface::delete()
     */
    public function delete(TaskEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}