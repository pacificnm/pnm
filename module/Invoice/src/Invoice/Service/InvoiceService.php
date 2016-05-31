<?php
namespace Invoice\Service;

use Invoice\Entity\InvoiceEntity;
use Invoice\Mapper\InvoiceMapperInterface;

class InvoiceService implements InvoiceServiceInterface
{

    /**
     *
     * @var InvoiceMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param InvoiceMapperInterface $mapper            
     */
    public function __construct(InvoiceMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Invoice\Service\InvoiceServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Invoice\Service\InvoiceServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Invoice\Service\InvoiceServiceInterface::save()
     */
    public function save(InvoiceEntity $invoiceEntity)
    {
        return $this->mapper->save($invoiceEntity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Invoice\Service\InvoiceServiceInterface::delete()
     */
    public function delete(InvoiceEntity $invoiceEntity)
    {
        return $this->mapper->delete($invoiceEntity);
    }
}