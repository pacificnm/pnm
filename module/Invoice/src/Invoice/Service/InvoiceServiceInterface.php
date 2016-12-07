<?php
namespace Invoice\Service;

use Invoice\Entity\InvoiceEntity;

interface InvoiceServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return InvoiceEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return InvoiceEntity
     */
    public function get($id);

    /**
     *
     * @param number $start            
     * @param number $end            
     * @param string $status            
     */
    public function getByDateRange($start, $end, $status);

    /**
     *
     * @param InvoiceEntity $entity            
     * @return InvoiceEntity
     */
    public function save(InvoiceEntity $entity);

    /**
     *
     * @param InvoiceEntity $entity            
     * @return boolean
     */
    public function delete(InvoiceEntity $entity);

    /**
     *
     * @param unknown $clientId            
     * @return InvoiceEntity
     */
    public function getClientUnpaidInvoices($clientId);

    /**
     *
     * @param number $start            
     * @param number $end            
     * @param string $invoiceStatus            
     * @param number $clientId            
     * @return InvoiceEntity
     */
    public function getTotalsFormMonth($start, $end, $invoiceStatus, $clientId = null);

    /**
     *
     * @param number $start            
     * @param number $end            
     * @param string $invoiceStatus            
     * @param number $clientId            
     * @return InvoiceEntity
     */
    public function getTotalsFormYear($start, $end, $invoiceStatus, $clientId = null);

    /**
     * Updates an invoice total
     * 
     * @param InvoiceEntity $entity            
     * @param float $amount            
     */
    public function updateInvoiceTotals(InvoiceEntity $entity, $amount);
}