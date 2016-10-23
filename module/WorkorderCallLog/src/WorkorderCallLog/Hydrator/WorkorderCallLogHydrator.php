<?php
namespace WorkorderCallLog\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use WorkorderCallLog\Entity\WorkorderCallLogEntity;
use CallLog\Entity\LogEntity;
use Employee\Entity\EmployeeEntity;
use Workorder\Entity\WorkorderEntity;
use Location\Entity\LocationEntity;
use User\Entity\UserEntity;

class WorkorderCallLogHydrator extends ClassMethods
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
        if (! $object instanceof WorkorderCallLogEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
  
        $callLogEntity = parent::hydrate($data, new LogEntity());
        
        $object->setCallLogEntity($callLogEntity);
        
        // join employee
        $employeeEntity = parent::hydrate($data, new EmployeeEntity());
        
        $object->getCallLogEntity()->setEmployeeEntity($employeeEntity);
        
        // workorder
        $workorderEntity = parent::hydrate($data, new WorkorderEntity());
        
        $object->setWorkorderEntity($workorderEntity);
        
        // location
        $locationEntity = parent::hydrate($data, new LocationEntity());
        
        $object->getWorkorderEntity()->setLocationEntity($locationEntity);
        
        // user
        $userEntity = parent::hydrate($data, new UserEntity());
        
        $object->getWorkorderEntity()->setUserEntity($userEntity);
        
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
        if (! $object instanceof WorkorderCallLogEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['call_log_entity']);
        
        unset($data['workorder_entity']);
        
        return $data;
    }
}