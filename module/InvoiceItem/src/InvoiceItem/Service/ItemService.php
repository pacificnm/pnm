<?php
namespace InvoiceItem\Service;

use InvoiceItem\Entity\ItemEntity;
use InvoiceItem\Mapper\ItemMapperInterface;

class ItemService implements ItemServiceInterface
{

    /**
     * 
     * @var ItemMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param ItemMapperInterface $mapper
     */
    public function __construct(ItemMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \InvoiceItem\Service\ItemServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \InvoiceItem\Service\ItemServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \InvoiceItem\Service\ItemServiceInterface::save()
     */
    public function save(ItemEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \InvoiceItem\Service\ItemServiceInterface::delete()
     */
    public function delete(ItemEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}