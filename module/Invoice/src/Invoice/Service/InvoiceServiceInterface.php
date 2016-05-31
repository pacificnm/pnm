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
     * @param InvoiceEntity $invoiceEntity
     * @return InvoiceEntity
     */
    public function save(InvoiceEntity $invoiceEntity);
    
    /**
     *
     * @param InvoiceEntity $invoiceEntity
     * @return boolean
     */
    public function delete(InvoiceEntity $invoiceEntity);
}