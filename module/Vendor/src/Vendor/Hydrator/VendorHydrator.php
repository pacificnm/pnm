<?php
namespace Vendor\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Vendor\Entity\VendorEntity;

class VendorHydrator extends ClassMethods
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
        if (! $object instanceof VendorEntity) {
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
        if (! $object instanceof VendorEntity) {
            return $object;
        }
    
        $data = parent::extract($object);
    
        return $data;
    }
}