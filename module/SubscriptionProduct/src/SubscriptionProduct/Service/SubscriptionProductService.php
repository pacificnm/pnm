<?php
namespace SubscriptionProduct\Service;

use SubscriptionProduct\Entity\SubscriptionProductEntity;
use SubscriptionProduct\Mapper\MysqlMapperInterface;

class SubscriptionProductService implements SubscriptionProductServiceInterface
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
     * @see \SubscriptionProduct\Service\SubscriptionProductServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionProduct\Service\SubscriptionProductServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionProduct\Service\SubscriptionProductServiceInterface::save()
     */
    public function save(SubscriptionProductEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionProduct\Service\SubscriptionProductServiceInterface::delete()
     */
    public function delete(SubscriptionProductEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

