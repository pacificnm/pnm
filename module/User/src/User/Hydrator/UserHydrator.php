<?php
namespace User\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use User\Entity\UserEntity;

class UserHydrator extends ClassMethods
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
        if (! $object instanceof UserEntity) {
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
        if (! $object instanceof UserEntity) {
            return $object;
        }
    
        $data = parent::extract($object);
    
        return $data;
    }
}