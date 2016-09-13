<?php
namespace HostFile\Service;

use HostFile\Entity\HostFileEntity;
use HostFile\Mapper\HostFileMapperInterface;

class HostFileService implements HostFileServiceInterface
{

    /**
     * 
     * @var HostFileMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param HostFileMapperInterface $mapper
     */
    public function __construct(HostFileMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostFile\Service\HostFileServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostFile\Service\HostFileServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostFile\Service\HostFileServiceInterface::save()
     */
    public function save(HostFileEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostFile\Service\HostFileServiceInterface::createHostFile()
     */
    public function createHostFile($fileId, $hostId)
    {
        return $this->mapper->createHostFile($fileId, $hostId);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostFile\Service\HostFileServiceInterface::delete()
     */
    public function delete(HostFileEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostFile\Service\HostFileServiceInterface::getHostFiles()
     */
    public function getHostFiles($hostId)
    {
        return $this->mapper->getHostFiles($hostId);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostFile\Service\HostFileServiceInterface::deleteHostFile()
     */
    public function deleteHostFile($fileId)
    {
        return $this->mapper->deleteHostFile($fileId);
    }
}