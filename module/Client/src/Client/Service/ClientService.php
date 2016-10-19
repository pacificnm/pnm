<?php
namespace Client\Service;

use Client\Entity\ClientEntity;
use Zend\Cache\Storage\Adapter\Memcached;
use Client\Mapper\MysqlMapperInterface;

class ClientService implements ClientServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
     */
    protected $mapper;

    /**
     *
     * @var Memcached
     */
    protected $memcached;

    /**
     *
     * @param MysqlMapperInterface $mapper            
     * @param Memcached $memcached            
     */
    public function __construct(MysqlMapperInterface $mapper, Memcached $memcached)
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
     * @see \Client\Service\ClientServiceInterface::getClientByName()
     */
    public function getClientByName($clientName)
    {
        return $this->mapper->getClientByName($clientName);
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
     * @see \Client\Service\ClientServiceInterface::createClient()
     */
    public function createClient($clientName, $clientStatus)
    {
        return $this->mapper->createClient($clientName, $clientStatus);
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