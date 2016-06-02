<?php
namespace Workorder\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Workorder\Entity\WorkorderEntity;
use Location\Entity\LocationEntity;
use Phone\Entity\PhoneEntity;
use User\Entity\UserEntity;

class WorkorderHydrator extends ClassMethods
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
        if (! $object instanceof WorkorderEntity) {
            return $object;
        }
    
        parent::hydrate($data, $object);
    
        $locationEntity = parent::hydrate($data, new LocationEntity());
        
        $object->setLocationEntity($locationEntity);
        
        $phoneEntity = parent::hydrate($data, new PhoneEntity());
        
        $object->setPhoneEntity($phoneEntity);
        
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
        if (! $object instanceof WorkorderEntity) {
            return $object;
        }
    
        $data = parent::extract($object);
    
        unset($data['client_entity']);
        
        unset($data['user_entity']);
        
        unset($data['phone_entity']);
        
        unset($data['location_entity']);
        
        return $data;
    }
}