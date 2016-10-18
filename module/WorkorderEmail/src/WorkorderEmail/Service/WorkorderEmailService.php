<?php
namespace WorkorderEmail\Service;

use WorkorderEmail\Entity\WorkorderEmailEntity;
use WorkorderEmail\Mapper\MysqlMapperInterface;
use Email\Service\EmailServiceInterface;

class WorkorderEmailService implements WorkorderEmailServiceInterface
{
    /**
     * 
     * @var MysqlMapperInterface
     */
    protected $mapper;
    
    /**
     * 
     * @var EmailServiceInterface
     */
    protected $emailService;
    
    /**
     * 
     * @param MysqlMapperInterface $mapper
     * @param EmailServiceInterface $emailService
     */
    public function __construct(MysqlMapperInterface $mapper, EmailServiceInterface $emailService)
    {
     
        $this->mapper = $mapper;
        
        $this->emailService = $emailService;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderEmail\Service\WorkorderEmailServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderEmail\Service\WorkorderEmailServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderEmail\Service\WorkorderEmailServiceInterface::save()
     */
    public function save(WorkorderEmailEntity $entity)
    {
        return $this->mapper->save($entity);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderEmail\Service\WorkorderEmailServiceInterface::delete()
     */
    public function delete(WorkorderEmailEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
    
    public  function sendEmailCreate()
    {
        
    }
}