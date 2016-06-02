<?php
namespace Network\Service;

use Network\Entity\NetworkEntity;
use Network\Mapper\NetworkMapperInterface;

class NetworkService implements NetworkServiceInterface
{

    /**
     *
     * @var NetworkMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param NetworkMapperInterface $mapper            
     */
    public function __construct(NetworkMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Network\Service\NetworkServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Network\Service\NetworkServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Network\Service\NetworkServiceInterface::save()
     */
    public function save(NetworkEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Network\Service\NetworkServiceInterface::delete()
     */
    public function delete(NetworkEntity $entity)
    {
        return $this->mapper->save($entity);
    }
}