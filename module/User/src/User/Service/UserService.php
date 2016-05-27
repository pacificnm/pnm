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
     *
     * @see \User\Service\UserServiceInterface::save()
     */
    public function save(UserEntity $userEntity)
    {
        return $this->mapper->save($userEntity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \User\Service\UserServiceInterface::delete()
     */
    public function delete(UserEntity $userEntity)
    {
        return $this->mapper->delete($userEntity);
    }
}