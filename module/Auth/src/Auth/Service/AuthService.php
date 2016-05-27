<?php
namespace Auth\Service;

use Auth\Entity\AuthEntity;
use Auth\Mapper\AuthMapperInterface;

class AuthService implements AuthServiceInterface
{

    /**
     * 
     * @var AuthMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @param AuthMapperInterface $mapper
     */
    public function __construct(AuthMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Auth\Service\AuthServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Auth\Service\AuthServiceInterface::getAuth()
     */
    public function getAuth($authEmail, $authPassword)
    {
        return $this->mapper->getAuth($authEmail, $authPassword);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Auth\Service\AuthServiceInterface::getAuthByEmail()
     */
    public function getAuthByEmail($authEmail)
    {
        return $this->mapper->getAuthByEmail($authEmail);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Auth\Service\AuthServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Auth\Service\AuthServiceInterface::save()
     */
    public function save(AuthEntity $authEntity)
    {
        return $this->mapper->save($authEntity);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Auth\Service\AuthServiceInterface::delete()
     */
    public function delete(AuthEntity $authEntity)
    {
        return $this->mapper->delete($authEntity);
    }
}
