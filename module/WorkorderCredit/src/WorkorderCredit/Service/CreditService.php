<?php
namespace WorkorderCredit\Service;

use WorkorderCredit\Entity\CreditEntity;
use WorkorderCredit\Mapper\CreditMapperInterface;

class CreditService implements CreditServiceInterface
{
    /**
     * 
     * @var CreditMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param CreditMapperInterface $mapper
     */
    public function __construct(CreditMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderCredit\Service\CreditServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderCredit\Service\CreditServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderCredit\Service\CreditServiceInterface::save()
     */
    public function save(CreditEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderCredit\Service\CreditServiceInterface::delete()
     */
    public function delete(CreditEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderCredit\Service\CreditServiceInterface::getWorkorderTotal()
     */
    public function getWorkorderTotal($workorderId)
    {
       return $this->mapper->getWorkorderTotal($workorderId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderCredit\Service\CreditServiceInterface::getWorkorderCredit()
     */
    public function getWorkorderCredit($workorderId)
    {
        return $this->mapper->getWorkorderCredit($workorderId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderCredit\Service\CreditServiceInterface::getWorkorderCreditBalance()
     */
    public function getWorkorderCreditBalance($clientId)
    {
        return $this->mapper->getWorkorderCreditBalance($clientId);    
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderCredit\Service\CreditServiceInterface::getWorkorderLaborCredit()
     */
    public function getWorkorderLaborCredit($workorderId)
    {
        return $this->mapper->getWorkorderLaborCredit($workorderId);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderCredit\Service\CreditServiceInterface::getWorkorderPartCredit()
     */
    public function getWorkorderPartCredit($workorderId)
    {
        return $this->mapper->getWorkorderPartCredit($workorderId);
    }
}
