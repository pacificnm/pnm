<?php
namespace AclRole\Service;

use AclRole\Entity\RoleEntity;
use AclRole\Mapper\RoleMapperInterface;

class RoleService implements RoleServiceInterface
{

    /**
     *
     * @var RoleMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param RoleMapperInterface $mapper            
     */
    public function __construct(RoleMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \AclRole\Service\RoleServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \AclRole\Service\RoleServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \AclRole\Service\RoleServiceInterface::getRole()
     */
    public function getRole($role)
    {
        return $this->mapper->getRole($role);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \AclRole\Service\RoleServiceInterface::save()
     */
    public function save(RoleEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \AclRole\Service\RoleServiceInterface::delete()
     */
    public function delete(RoleEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}