<?php
namespace Auth\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Auth\Entity\AuthEntity;
use Employee\Entity\EmployeeEntity;
use User\Entity\UserEntity;

class AuthHydrator extends ClassMethods
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
        if (! $object instanceof AuthEntity) {
            return $object;
        }
    
        parent::hydrate($data, $object);
        
        $employeeEntity = parent::hydrate($data, new EmployeeEntity());
        
        $object->setEmployeeEntity($employeeEntity);
        
        $userEntity = parent::hydrate($data, new UserEntity());
        
        $object->setUserEntity($userEntity);
        
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
        if (! $object instanceof AuthEntity) {
            return $object;
        }
    
        $data = parent::extract($object);
    
        unset($data['user_entity']);
        
        unset($data['employee_entity']);
        
        return $data;
    }
}