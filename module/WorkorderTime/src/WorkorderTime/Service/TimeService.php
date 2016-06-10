<?php
namespace WorkorderTime\Service;

use WorkorderTime\Entity\TimeEntity;
use WorkorderTime\Mapper\TimeMapperInterface;

class TimeService implements TimeServiceInterface
{

    /**
     *
     * @var TimeMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param TimeMapperInterface $mapper            
     */
    public function __construct(TimeMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderTime\Service\TimeServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderTime\Service\TimeServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderTime\Service\TimeServiceInterface::save()
     */
    public function save(TimeEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderTime\Service\TimeServiceInterface::delete()
     */
    public function delete(TimeEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderTime\Service\TimeServiceInterface::getWorkorderTimes()
     */
    public function getWorkorderTimes($workorderId)
    {
        $filter = array(
            'workorderId' => $workorderId
        );
        
        return $this->mapper->getAll($filter);
    }
}