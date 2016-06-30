<?php
namespace WorkorderTime\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use WorkorderTime\Entity\TimeEntity;
use Employee\Entity\EmployeeEntity;
use Workorder\Entity\WorkorderEntity;
use Client\Entity\ClientEntity;

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
        
        // set client entity
        $employeeEntity = parent::hydrate($data, new EmployeeEntity());
        
        $object->setEmployeeEntity($employeeEntity);
        
        //set workorder
        $workorderEntity = parent::hydrate($data, new WorkorderEntity());
        
        // if we have a workorderEntity set the client
        if($workorderEntity) {
            $clientEntity = parent::hydrate($data, new ClientEntity());
             $workorderEntity->setClientEntity($clientEntity);
        }
        
        $object->setWorkorderEntity($workorderEntity);
        
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
        
        unset($data['workorder_entity']);
        
        return $data;
    }
}