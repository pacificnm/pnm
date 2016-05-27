<?php
namespace Client\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Client\Entity\ClientEntity;

class ClientHydrator extends ClassMethods
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
        if (! $object instanceof ClientEntity) {
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
        if (! $object instanceof ClientEntity) {
            return $object;
        }
    
        $data = parent::extract($object);
    
        return $data;
    }
}
