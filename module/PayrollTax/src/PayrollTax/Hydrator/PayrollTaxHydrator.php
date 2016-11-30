<?php
namespace PayrollTax\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use PayrollTax\Entity\PayrollTaxEntity;

class PayrollTaxHydrator extends ClassMethods
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
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::hydrate()
     */
    public function hydrate(array $data, $object)
    {
        if (! $object instanceof PayrollTaxEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        return $object;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::extract()
     */
    public function extract($object)
    {
        if (! $object instanceof PayrollTaxEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        return $data;
    }
}

