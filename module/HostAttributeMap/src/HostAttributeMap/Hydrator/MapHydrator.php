<?php
namespace HostAttributeMap\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use HostAttributeMap\Entity\MapEntity;
use HostAttribute\Entity\AttributeEntity;

class MapHydrator extends ClassMethods
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
        if (! $object instanceof MapEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $attributeEntity = parent::hydrate($data, new AttributeEntity());
        
        $object->setAttributeEntity($attributeEntity);
        
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
        if (! $object instanceof MapEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['attribute_entity']);
        
        return $data;
    }
}