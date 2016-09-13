<?php
namespace ClientFile\Service;

use ClientFile\Entity\ClientFileEntity;
use ClientFile\Mapper\ClientFileMapperInterface;

class ClientFileService implements ClientFileServiceInterface
{

    /**
     *
     * @var ClientFileMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param ClientFileMapperInterface $mapper            
     */
    public function __construct(ClientFileMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFile\Service\ClientFileServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFile\Service\ClientFileServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFile\Service\ClientFileServiceInterface::save()
     */
    public function save(ClientFileEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFile\Service\ClientFileServiceInterface::delete()
     */
    public function delete(ClientFileEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \ClientFile\Service\ClientFileServiceInterface::getClientFiles()
     */
    public function getClientFiles($clientId)
    {
        return $this->mapper->getClientFiles($clientId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \ClientFile\Service\ClientFileServiceInterface::createClientFile()
     */
    public function createClientFile($fileId, $clientId)
    {
        return $this->mapper->createClientFile($fileId, $clientId);
    }
}