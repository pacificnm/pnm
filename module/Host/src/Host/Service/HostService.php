<?php
namespace Host\Service;

use Host\Entity\HostEntity;
use Host\Mapper\MysqlMapperInterface;

class HostService implements HostServiceInterface
{

    /**
     *
     * @var MysqlMapperInterface
     */
    protected $mapper;

    /**
     *
     * @param HostMapperInterface $mapper            
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::getClientHostNotInWorkorder()
     */
    public function getClientHostNotInWorkorder($clientId, $workorderId)
    {
        return $this->mapper->getClientHostNotInWorkorder($clientId, $workorderId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::getClientHosts()
     */
    public function getClientHosts($clientId)
    {
        return $this->mapper->getClientHosts($clientId);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::save()
     */
    public function save(HostEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::create()
     */
    public function create($clientId, $hostDescription, $hostHealth, $hostIp, $hostName, $hostStatus, $hostTypeId, $locationId)
    {
        $entity = new HostEntity();
        
        $entity->setClientId($clientId);
        
        $entity->setLocationId($locationId);
        
        $entity->setHostCreated(time());
        
        $entity->setHostDescription($hostDescription);
        
        $entity->setHostHealth($hostHealth);
        
        $entity->setHostId(0);
        
        $entity->setHostIp($hostIp);
        
        $entity->setHostName($hostName);
        
        $entity->setHostStatus($hostStatus);
        
        $entity->setHostTypeId($hostTypeId);
        
        return $this->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Host\Service\HostServiceInterface::delete()
     */
    public function delete(HostEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}