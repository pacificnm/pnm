<?php
namespace WorkorderPart\Service;

use WorkorderPart\Entity\PartEntity;
use WorkorderPart\Mapper\PartMapperInterface;

class PartsService implements PartServiceInterface
{

    /**
     *
     * @var PartMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param PartMapperInterface $mapper            
     */
    public function __construct(PartMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderPart\Service\PartServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderPart\Service\PartServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderPart\Service\PartServiceInterface::save()
     */
    public function save(PartEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderPart\Service\PartServiceInterface::delete()
     */
    public function delete(PartEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderPart\Service\PartServiceInterface::getWorkorderParts()
     */
    public function getWorkorderParts($workorderId)
    {
        $filter = array(
            'workorderId' => $workorderId
        );
        
        return $this->mapper->getAll($filter);
    }
}