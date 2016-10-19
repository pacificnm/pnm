<?php
namespace HostType\Service;

use HostType\Entity\TypeEntity;
use HostType\Mapper\TypeMapperInterface;

class TypeService implements TypeServiceInterface
{

    /**
     *
     * @var TypeMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param TypeMapperInterface $mapper            
     */
    public function __construct(TypeMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostType\Service\TypeServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostType\Service\TypeServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostType\Service\TypeServiceInterface::getTypeByName()
     */
    public function getTypeByName($hostTypeName)
    {
        return $this->mapper->getTypeByName($hostTypeName);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostType\Service\TypeServiceInterface::save()
     */
    public function save(TypeEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostType\Service\TypeServiceInterface::delete()
     */
    public function delete(TypeEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}