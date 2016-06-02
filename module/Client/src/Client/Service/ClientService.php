<?php
namespace Client\Service;

use Client\Entity\ClientEntity;
use Client\Mapper\ClientMapperInterface;

class ClientService implements ClientServiceInterface
{

    /**
     * 
     * @var ClientMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param ClientMapperInterface $mapper
     */
    public function __construct(ClientMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Client\Service\ClientServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Client\Service\ClientServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Client\Service\ClientServiceInterface::save()
     */
    public function save(ClientEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Client\Service\ClientServiceInterface::delete()
     */
    public function delete(ClientEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}