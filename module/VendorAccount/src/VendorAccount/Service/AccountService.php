<?php
namespace VendorAccount\Service;

use VendorAccount\Entity\AccountEntity;
use VendorAccount\Mapper\AccountMapperInterface;

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
     *
     * @see \VendorAccount\Service\AccountServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorAccount\Service\AccountServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VendorAccount\Service\AccountServiceInterface::getVendorAccount()
     */
    public function getVendorAccount($vendorId)
    {
        return $this->mapper->getVendorAccount($vendorId);    
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorAccount\Service\AccountServiceInterface::save()
     */
    public function save(AccountEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorAccount\Service\AccountServiceInterface::delete()
     */
    public function delete(AccountEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}