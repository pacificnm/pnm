<?php
namespace SubscriptionInvoice\Service;

use SubscriptionInvoice\Entity\SubscriptionInvoiceEntity;
use SubscriptionInvoice\Mapper\MysqlMapperInterface;

class SubscriptionInvoiceService implements SubscriptionInvoiceServiceInterface
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
     * @see \SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface::save()
     */
    public function save(SubscriptionInvoiceEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionInvoice\Service\SubscriptionInvoiceServiceInterface::delete()
     */
    public function delete(SubscriptionInvoiceEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}