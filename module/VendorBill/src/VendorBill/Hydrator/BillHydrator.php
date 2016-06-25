<?php
namespace VendorBill\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use VendorBill\Entity\BillEntity;
use Vendor\Entity\VendorEntity;

class BillHydrator extends ClassMethods
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
        if (! $object instanceof BillEntity) {
            return $object;
        }
    
        parent::hydrate($data, $object);
    
        $vendorEntity = parent::hydrate($data, new VendorEntity());
        
        $object->setVendorEntity($vendorEntity);
        
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
        if (! $object instanceof BillEntity) {
            return $object;
        }
    
        $data = parent::extract($object);
    
        unset($data['vendor_entity']);
        
        return $data;
    }
}