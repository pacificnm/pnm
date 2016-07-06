<?php
namespace Invoice\Mapper;

use Invoice\Entity\InvoiceEntity;

interface InvoiceMapperInterface
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
}