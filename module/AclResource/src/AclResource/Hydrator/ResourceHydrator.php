<?php
namespace AclResource\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use AclResource\Entity\ResourceEntity;

class ResourceHydrator extends ClassMethods
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
        if (! $object instanceof ResourceEntity) {
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
        if (! $object instanceof ResourceEntity) {
            return $object;
        }
    
        $data = parent::extract($object);

    
        return $data;
    }
}