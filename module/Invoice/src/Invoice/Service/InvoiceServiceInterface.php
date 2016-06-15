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
}