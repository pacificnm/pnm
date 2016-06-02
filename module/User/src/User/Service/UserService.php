<?php
namespace User\Service;

use User\Entity\UserEntity;
use User\Mapper\UserMapperInterface;

class UserService implements UserServiceInterface
{

    /**
     *
     * @var UserMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param UserMapperInterface $mapper            
     */
    public function __construct(UserMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \User\Service\UserServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \User\Service\UserServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \User\Service\UserServiceInterface::getPrimaryUserByLocation()
     */
    public function getPrimaryUserByLocation($locationId)
    {
        return $this->mapper->getPrimaryUserByLocation($locationId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \User\Service\UserServiceInterface::save()
     */
    public function save(UserEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \User\Service\UserServiceInterface::delete()
     */
    public function delete(UserEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}