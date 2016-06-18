<?php
namespace HostAttribute\Service;

use HostAttribute\Entity\AttributeEntity;
use HostAttribute\Mapper\AttributeMapperInterface;

class AttributeService implements AttributeServiceInterface
{

    /**
     *
     * @var AttributeMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param AttributeMapperInterface $mapper            
     */
    public function __construct(AttributeMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostAttribute\Service\AttributeServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostAttribute\Service\AttributeServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostAttribute\Service\AttributeServiceInterface::save()
     */
    public function save(AttributeEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostAttribute\Service\AttributeServiceInterface::delete()
     */
    public function delete(AttributeEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    
}
