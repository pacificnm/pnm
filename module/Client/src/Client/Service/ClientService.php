<?php
namespace Client\Service;

use Client\Entity\ClientEntity;
use Client\Mapper\ClientMapperInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class ClientService implements ClientServiceInterface
{

    /**
     *
     * @var ClientMapperInterface
     */
    protected $mapper;

    /**
     *
     * @var Memcached
     */
    protected $memcached;

    /**
     *
     * @param ClientMapperInterface $mapper            
     * @param Memcached $memcached            
     */
    public function __construct(ClientMapperInterface $mapper, Memcached $memcached)
    {
        $this->mapper = $mapper;
        
        $this->memcached = $memcached;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Service\ClientServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Service\ClientServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Service\ClientServiceInterface::save()
     */
    public function save(ClientEntity $entity)
    {
        return $this->mapper->save($entity);

    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Service\ClientServiceInterface::delete()
     */
    public function delete(ClientEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}