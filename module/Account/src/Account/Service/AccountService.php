<?php
namespace Account\Service;

use Account\Entity\AccountEntity;
use Account\Mapper\AccountMapperInterface;

class AccountService implements AccountServiceInterface
{

    /**
     * 
     * @var AccountMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param AccountMapperInterface $mapper
     */
    public function __construct(AccountMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Account\Service\AccountServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Account\Service\AccountServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Account\Service\AccountServiceInterface::getNonSystemAccounts()
     */
    public function getNonSystemAccounts()
    {
        return $this->mapper->getNonSystemAccounts();
    }
    
    
    /**
     * 
     * {@inheritDoc}
     * @see \Account\Service\AccountServiceInterface::save()
     */
    public function save(AccountEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Account\Service\AccountServiceInterface::delete()
     */
    public function delete(AccountEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}