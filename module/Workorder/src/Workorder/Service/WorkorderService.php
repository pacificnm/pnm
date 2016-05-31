<?php
namespace Workorder\Service;

use Workorder\Entity\WorkorderEntity;
use Workorder\Mapper\WorkorderMapperInterface;

class WorkorderService implements WorkorderServiceInterface
{

    /**
     *
     * @var WorkorderMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param WorkorderMapperInterface $mapper            
     */
    public function __construct(WorkorderMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::save()
     */
    public function save(WorkorderEntity $workorderEntity)
    {
        return $this->mapper->save($workorderEntity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Workorder\Service\WorkorderServiceInterface::delete()
     */
    public function delete(WorkorderEntity $workorderEntity)
    {
        return $this->mapper->delete($workorderEntity);
    }
}