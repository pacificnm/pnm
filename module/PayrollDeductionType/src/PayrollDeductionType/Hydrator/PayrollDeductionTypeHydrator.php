<?php
namespace PayrollDeductionType\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use PayrollDeductionType\Entity\PayrollDeductionTypeEntity;

class PayrollDeductionTypeHydrator extends ClassMethods
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
        if (! $object instanceof PayrollDeductionTypeEntity) {
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
        if (! $object instanceof PayrollDeductionTypeEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        return $data;
    }
}