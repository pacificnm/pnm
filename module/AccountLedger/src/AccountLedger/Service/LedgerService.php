<?php
namespace AccountLedger\Service;

use AccountLedger\Entity\LedgerEntity;
use AccountLedger\Mapper\LedgerMapperInterface;

class LedgerService implements LedgerServiceInterface
{

    /**
     * 
     * @var LedgerMapperInterface
     */
    protected $mapper;

    
    /**
     * 
     * @param LedgerMapperInterface $mapper
     */
    public function __construct(LedgerMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::save()
     */
    public function save(LedgerEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AccountLedger\Service\LedgerServiceInterface::delete()
     */
    public function delete(LedgerEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    
}