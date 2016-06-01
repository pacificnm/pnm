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
     *
     * @see \Host\Service\HostServiceInterface::save()
     */
    public function save(HostEntity $hostEntity)
    {
        return $this->mapper->save($hostEntity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::delete()
     */
    public function delete(HostEntity $hostEntity)
    {
        return $this->mapper->delete($hostEntity);
    }
}