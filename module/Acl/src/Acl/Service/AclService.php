<?php
namespace Acl\Service;

use Zend\Cache\Storage\Adapter\Memcached;
use Acl\Entity\AclEntity;
use Acl\Mapper\AclMapperInterface;

class AclService implements AclServiceInterface
{

    /**
     *
     * @var AclMapperInterface
     */
    protected $mapper;

    /**
     * 
     * @var Memcached
     */
    protected $memcached;
    
    /**
     *
     * @param AclMapperInterface $mapper            
     * @param Memcached $memcached            
     */
    public function __construct(AclMapperInterface $mapper, Memcached $memcached)
    {
        $this->mapper = $mapper;
        
        $this->memcached = $memcached;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Acl\Service\AclServiceInterface::getAclRule()
     */
    public function getAclRule($role, $resource)
    {
        return $this->mapper->getAclRule($role, $resource);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Acl\Service\AclServiceInterface::getAll()
     */
    public function getAll($filter)
    {
        if(array_key_exists('pagination', $filter) && $filter['pagination'] == 'off') {
            
            $key = 'acl-get-all';
            
            $aclEntitys = $this->memcached->getItem($key);
            
            if(! $aclEntitys) {
                
                $aclEntitys = $this->mapper->getAll($filter);
                
                $this->memcached->setItem($key, $aclEntitys);
            }
            
            return $aclEntitys;
        }
        
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Acl\Service\AclServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Acl\Service\AclServiceInterface::save()
     */
    public function save(AclEntity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Acl\Service\AclServiceInterface::delete()
     */
    public function delete(AclEntity $entity)
    {
        return $this->mapper->delete($entity);
    }
}