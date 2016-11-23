<?php
namespace SubscriptionStatus\Service;

use SubscriptionStatus\Entity\SubscriptionStatusEntity;
use SubscriptionStatus\Mapper\MysqlMapperInterface;

class SubscriptionStatusService implements SubscriptionStatusServiceInterface
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
     * @see \SubscriptionStatus\Service\SubscriptionStatusServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionStatus\Service\SubscriptionStatusServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionStatus\Service\SubscriptionStatusServiceInterface::save()
     */
    public function save(SubscriptionStatusEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionStatus\Service\SubscriptionStatusServiceInterface::getActive()
     */
    public function getActive()
    {
        return $this->mapper->getActive();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionStatus\Service\SubscriptionStatusServiceInterface::delete()
     */
    public function delete(SubscriptionStatusEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}