<?php
namespace Client\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Client\Entity\ClientEntity;
use Location\Entity\LocationEntity;
use Phone\Entity\PhoneEntity;

class ClientHydrator extends ClassMethods
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
        if (! $object instanceof ClientEntity) {
            return $object;
        }
    
        parent::hydrate($data, $object);
    
        $locationEntity = parent::hydrate($data, new LocationEntity());
        
        $object->setLocationEntity($locationEntity);
        
        $phoneEntity = parent::hydrate($data, new PhoneEntity());
        
        $object->setPhoneEntity($phoneEntity);
        
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
        if (! $object instanceof ClientEntity) {
            return $object;
        }
    
        $data = parent::extract($object);
    
        unset($data['location_entity']);
        
        unset($data['phone_entity']);
        
        unset($data['user_entity']);
        
        return $data;
    }
}
