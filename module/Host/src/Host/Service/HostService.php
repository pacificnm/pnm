<?php
namespace Host\Service;

use Host\Entity\HostEntity;
use Host\Mapper\HostMapperInterface;

class HostService implements HostServiceInterface
{

    /**
     *
     * @var HostMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param HostMapperInterface $mapper            
     */
    public function __construct(HostMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Host\Service\HostServiceInterface::getClientHostNotInWorkorder()
     */
    public function getClientHostNotInWorkorder($clientId, $workorderId)
    {
        return $this->mapper->getClientHostNotInWorkorder($clientId, $workorderId);    
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::save()
     */
    public function save(HostEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::delete()
     */
    public function delete(HostEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}