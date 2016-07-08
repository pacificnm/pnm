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
     * @see \Invoice\Service\InvoiceServiceInterface::getByDateRange()
     */
    public function getByDateRange($start, $end, $status)
    {
        return $this->mapper->getByDateRange($start, $end, $status);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Invoice\Service\InvoiceServiceInterface::save()
     */
    public function save(InvoiceEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Invoice\Service\InvoiceServiceInterface::delete()
     */
    public function delete(InvoiceEntity $entity)
    {
        return $this->mapper->delete($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Invoice\Service\InvoiceServiceInterface::getClientUnpaidInvoices()
     */
    public function getClientUnpaidInvoices($clientId)
    {
        $filter = array(
            'clientId' => $clientId,
            'invoiceStatus' => 'Un-Paid'
        );
        
        return $this->mapper->getAll($filter);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Invoice\Service\InvoiceServiceInterface::getTotalsFormMonth()
     */
    public function getTotalsFormMonth($start, $end, $invoiceStatus, $clientId = null)
    {
        return $this->mapper->getTotalsFormMonth($start, $end, $invoiceStatus, $clientId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Invoice\Service\InvoiceServiceInterface::getTotalsFormYear()
     */
    public function getTotalsFormYear($start, $end, $invoiceStatus, $clientId = null)
    {
        return $this->mapper->getTotalsFormYear($start, $end, $invoiceStatus, $clientId);
    }
}