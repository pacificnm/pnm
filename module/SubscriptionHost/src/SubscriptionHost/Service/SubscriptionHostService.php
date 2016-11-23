<?php
namespace SubscriptionHost\Service;

use SubscriptionHost\Entity\SubscriptionHostEntity;
use SubscriptionHost\Mapper\MysqlMapperInterface;

class SubscriptionHostService implements SubscriptionHostServiceInterface
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
     * @see \SubscriptionHost\Service\SubscriptionHostServiceInterface::getHostsSubscription()
     */
    public function getHostsSubscription($subscriptionId)
    {
        return $this->mapper->getHostsSubscription($subscriptionId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionHost\Service\SubscriptionHostServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionHost\Service\SubscriptionHostServiceInterface::getHostSubscription()
     */
    public function getHostSubscription($hostId)
    {
        return $this->mapper->getHostSubscription($hostId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionHost\Service\SubscriptionHostServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionHost\Service\SubscriptionHostServiceInterface::save()
     */
    public function save(SubscriptionHostEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionHost\Service\SubscriptionHostServiceInterface::delete()
     */
    public function delete(SubscriptionHostEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}
