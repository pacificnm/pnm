<?php
namespace InvoicePayment\Service;

use InvoicePayment\Entity\PaymentEntity;
use InvoicePayment\Mapper\PaymentMapperInterface;

class PaymentService implements PaymentServiceInterface
{

    /**
     *
     * @var PaymentMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param PaymentMapperInterface $mapper            
     */
    public function __construct(PaymentMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \InvoicePayment\Service\PaymentServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \InvoicePayment\Service\PaymentServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \InvoicePayment\Service\PaymentServiceInterface::getInvoicePayments()
     */
    public function getInvoicePayments($invoiceId)
    {
        return $this->mapper->getInvoicePayments($invoiceId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \InvoicePayment\Service\PaymentServiceInterface::save()
     */
    public function save(PaymentEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \InvoicePayment\Service\PaymentServiceInterface::delete()
     */
    public function delete(PaymentEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}