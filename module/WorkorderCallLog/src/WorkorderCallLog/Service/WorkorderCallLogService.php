<?php
namespace WorkorderCallLog\Service;

use WorkorderCallLog\Entity\WorkorderCallLogEntity;
use WorkorderCallLog\Mapper\MysqlMapperInterface;

class WorkorderCallLogService implements WorkorderCallLogServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param MysqlMapperInterface $mapper            
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCallLog\Service\WorkorderCallLogServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCallLog\Service\WorkorderCallLogServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCallLog\Service\WorkorderCallLogServiceInterface::getCallLogWorkorders()
     */
    public function getCallLogWorkorders($callLogId)
    {
        return $this->mapper->getCallLogWorkorders($callLogId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCallLog\Service\WorkorderCallLogServiceInterface::save()
     */
    public function save(WorkorderCallLogEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCallLog\Service\WorkorderCallLogServiceInterface::delete()
     */
    public function delete(WorkorderCallLogEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}