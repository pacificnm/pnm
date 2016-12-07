<?php
namespace SubscriptionUser\Service;

use SubscriptionUser\Entity\SubscriptionUserEntity;
use SubscriptionUser\Mapper\MysqlMapperInterface;

class SubscriptionUserService implements SubscriptionUserServiceInterface
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
     * {@inheritdoc}
     *
     * @see \SubscriptionUser\Service\SubscriptionUserServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionUser\Service\SubscriptionUserServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionUser\Service\SubscriptionUserServiceInterface::save()
     */
    public function save(SubscriptionUserEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionUser\Service\SubscriptionUserServiceInterface::delete()
     */
    public function delete(SubscriptionUserEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

