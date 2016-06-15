<?php
namespace User\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use User\Entity\UserEntity;
use Phone\Entity\PhoneEntity;
use Location\Entity\LocationEntity;

class UserHydrator extends ClassMethods
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
        if (! $object instanceof UserEntity) {
            return $object;
        }
    
        parent::hydrate($data, $object);
    
        $phoneEntity = parent::hydrate($data, new PhoneEntity());
        
        $locationEntity = parent::hydrate($data, new LocationEntity());
        
        $object->setPhoneEntity($phoneEntity);
        
        $object->setLocationEntity($locationEntity);
        
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
        if (! $object instanceof UserEntity) {
            return $object;
        }
    
        $data = parent::extract($object);
    
        unset($data['phone_entity']);
        
        unset($data['client_entity']);
        
        unset($data['location_entity']);
        
        return $data;
    }
}