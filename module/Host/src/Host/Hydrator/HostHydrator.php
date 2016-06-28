<?php
namespace Host\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Host\Entity\HostEntity;
use HostType\Entity\TypeEntity;
use Location\Entity\LocationEntity;

class HostHydrator extends ClassMethods
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
        if (! $object instanceof HostEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $typeEntity = parent::hydrate($data, new TypeEntity());
        
        $object->setTypeEntity($typeEntity);
        
        $locationEntity = parent::hydrate($data, new LocationEntity());
        
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
        if (! $object instanceof HostEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['type_entity']);
        
        unset($data['location_entity']);
        
        return $data;
    }
}
