<?php
namespace HostAttributeValue\Service;

use HostAttributeValue\Entity\ValueEntity;
use HostAttributeValue\Mapper\ValueMapperInterface;

class ValueService implements ValueServiceInterface
{
    /**
     * 
     * @var ValueMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param ValueMapperInterface $mapper
     */
    public function __construct(ValueMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeValue\Service\ValueServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeValue\Service\ValueServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeValue\Service\ValueServiceInterface::save()
     */
    public function save(ValueEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeValue\Service\ValueServiceInterface::delete()
     */
    public function delete(ValueEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeValue\Service\ValueServiceInterface::getAttributeValues()
     */
    public function getAttributeValues($attributeId)
    {
        $filter = array(
            'hostAttributeId' => $attributeId
        );
    
        return $this->mapper->getAll($filter);
    }
}