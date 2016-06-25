<?php
namespace AclRole\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use AclRole\Entity\RoleEntity;

class RoleHydrator extends ClassMethods
{
    /**
     *
     * @param string $underscoreSeparatedKeys
     */
    public function __construct($underscoreSeparatedKeys = true)
    {
        parent::__construct($underscoreSeparatedKeys);
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::hydrate()
     */
    public function hydrate(array $data, $object)
    {
        if (! $object instanceof RoleEntity) {
            return $object;
        }
    
        parent::hydrate($data, $object);
    
    
        return $object;
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::extract()
     */
    public function extract($object)
    {
        if (! $object instanceof RoleEntity) {
            return $object;
        }
    
        $data = parent::extract($object);
    
    
        return $data;
    }
}

?>