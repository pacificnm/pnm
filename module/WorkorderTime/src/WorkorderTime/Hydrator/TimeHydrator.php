<?php
namespace WorkorderTime\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use WorkorderTime\Entity\TimeEntity;
use Employee\Entity\EmployeeEntity;

class TimeHydrator extends ClassMethods
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
        if (! $object instanceof TimeEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $employeeEntity = parent::hydrate($data, new EmployeeEntity());
        
        $object->setEmployeeEntity($employeeEntity);
        
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
        if (! $object instanceof TimeEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['employee_entity']);
        
        return $data;
    }
}