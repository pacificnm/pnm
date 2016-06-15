<?php
namespace Task\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Task\Entity\TaskEntity;
use Employee\Entity\EmployeeEntity;
use TaskPriority\Entity\PriorityEntity;

class TaskHydrator extends ClassMethods
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
        if (! $object instanceof TaskEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        
        $employeeEntity = parent::hydrate($data, new EmployeeEntity());
        
        $object->setEmployeeEntity($employeeEntity);
        
        $priorityEntity = parent::hydrate($data, new PriorityEntity());
        
        $object->setPriorityEntity($priorityEntity);
        
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
        if (! $object instanceof TaskEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['employee_entity']);
        
        unset($data['client_entity']);
        
        unset($data['priority_entity']);
        
        return $data;
    }
}
