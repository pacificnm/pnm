<?php
namespace InvoiceItem\Service;

use InvoiceItem\Entity\ItemEntity;

interface ItemServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return ItemEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return ItemEntity
     */
    public function get($id);

    /**
     *
     * @param ItemEntity $entity            
     * @return ItemEntity
     */
    public function save(ItemEntity $entity);

    /**
     *
     * @param ItemEntity $entity            
     * @return boolean
     */
    public function delete(ItemEntity $entity);
}
