<?php
namespace SubscriptionSchedule\Service;

use SubscriptionSchedule\Entity\SubscriptionScheduleEntity;
use SubscriptionSchedule\Mapper\MysqlMapperInterface;

class SubscriptionScheduleService implements SubscriptionScheduleServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param MysqlMapperInterface $mapper            
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionSchedule\Service\SubscriptionScheduleServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionSchedule\Service\SubscriptionScheduleServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionSchedule\Service\SubscriptionScheduleServiceInterface::getActive()
     */
    public function getActive()
    {
        return $this->mapper->getActive();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionSchedule\Service\SubscriptionScheduleServiceInterface::save()
     */
    public function save(SubscriptionScheduleEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionSchedule\Service\SubscriptionScheduleServiceInterface::delete()
     */
    public function delete(SubscriptionScheduleEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}