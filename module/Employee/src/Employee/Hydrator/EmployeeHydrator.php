<?php
namespace Employee\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Employee\Entity\EmployeeEntity;
use Auth\Entity\AuthEntity;

class EmployeeHydrator extends ClassMethods
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
        if (! $object instanceof EmployeeEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $authEntity = parent::hydrate($data, new AuthEntity());
        
        $object->setAuthEntity($authEntity);
        
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
        if (! $object instanceof EmployeeEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['auth_entity']);
        
        return $data;
    }
}