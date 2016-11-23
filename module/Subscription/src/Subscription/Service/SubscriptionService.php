<?php
namespace Subscription\Service;

use Subscription\Entity\SubscriptionEntity;
use Subscription\Mapper\MysqlMapperInterface;

class SubscriptionService implements SubscriptionServiceInterface
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
     * @see \Subscription\Service\SubscriptionServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Subscription\Service\SubscriptionServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Subscription\Service\SubscriptionServiceInterface::getActive()
     */
    public function getActive()
    {
        return $this->mapper->getActive();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Subscription\Service\SubscriptionServiceInterface::save()
     */
    public function save(SubscriptionEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Subscription\Service\SubscriptionServiceInterface::delete()
     */
    public function delete(SubscriptionEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}