<?php
namespace AccountType\Service;

use AccountType\Entity\TypeEntity;
use AccountType\Mapper\TypeMapperInterface;

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
     * @see \AccountType\Service\TypeServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountType\Service\TypeServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountType\Service\TypeServiceInterface::save()
     */
    public function save(TypeEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountType\Service\TypeServiceInterface::delete()
     */
    public function delete(TypeEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}