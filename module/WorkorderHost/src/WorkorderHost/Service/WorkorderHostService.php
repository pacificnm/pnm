<?php
namespace WorkorderHost\Service;

use WorkorderHost\Entity\WorkorderHostEntity;
use WorkorderHost\Mapper\MysqlMapperInterface;

class WorkorderHostService implements WorkorderHostServiceInterface
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
     * @see \WorkorderHost\Service\WorkorderHostServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderHost\Service\WorkorderHostServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderHost\Service\WorkorderHostServiceInterface::getWorkorderHosts()
     */
    public function getWorkorderHosts($workorderId)
    {
        return $this->mapper->getWorkorderHosts($workorderId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderHost\Service\WorkorderHostServiceInterface::getNotInWorkorderHosts()
     */
    public function getNotInWorkorderHosts($clientId, $workorderId)
    {
        return $this->mapper->getNotInWorkorderHosts($clientId, $workorderId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderHost\Service\WorkorderHostServiceInterface::save()
     */
    public function save(WorkorderHostEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderHost\Service\WorkorderHostServiceInterface::delete()
     */
    public function delete(WorkorderHostEntity $entity)
    {
        return $this->mapper->delete($entity);
        
    }
}

