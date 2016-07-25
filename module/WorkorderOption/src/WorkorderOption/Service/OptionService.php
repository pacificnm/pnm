<?php
namespace WorkorderOption\Service;

use WorkorderOption\Entity\OptionEntity;
use WorkorderOption\Mapper\OptionMapperInterface;

class OptionService implements OptionServiceInterface
{
    /**
     * 
     * @var OptionMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param OptionMapperInterface $mapper
     */
    public function __construct(OptionMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderOption\Service\OptionServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderOption\Service\OptionServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderOption\Service\OptionServiceInterface::save()
     */
    public function save(OptionEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderOption\Service\OptionServiceInterface::delete()
     */
    public function delete(OptionEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

