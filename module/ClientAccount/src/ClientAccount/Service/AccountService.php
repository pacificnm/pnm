<?php
namespace ClientAccount\Service;

use ClientAccount\Entity\AccountEntity;
use ClientAccount\Mapper\AccountMapperInterface;

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
     * @see \ClientAccount\Service\AccountServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientAccount\Service\AccountServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * \
     *
     * {@inheritDoc}
     *
     * @see \ClientAccount\Service\AccountServiceInterface::getClientAccount()
     */
    public function getClientAccount($clientId)
    {
        return $this->mapper->getClientAccount($clientId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientAccount\Service\AccountServiceInterface::save()
     */
    public function save(AccountEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientAccount\Service\AccountServiceInterface::delete()
     */
    public function delete(AccountEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}
