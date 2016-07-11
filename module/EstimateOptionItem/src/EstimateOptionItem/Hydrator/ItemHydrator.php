<?php
namespace EstimateOptionItem\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use EstimateOptionItem\Entity\ItemEntity;

class ItemHydrator extends ClassMethods
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
        if (! $object instanceof ItemEntity) {
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
        if (! $object instanceof ItemEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['client_entity']);
        
        unset($data['employee_entity']);
        
        return $data;
    }
}

?>