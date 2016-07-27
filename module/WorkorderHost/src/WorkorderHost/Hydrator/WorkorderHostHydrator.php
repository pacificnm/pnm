<?php
namespace WorkorderHost\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use WorkorderHost\Entity\WorkorderHostEntity;
use Host\Entity\HostEntity;

class WorkorderHostHydrator extends ClassMethods
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
        if (! $object instanceof WorkorderHostEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $hostEntity = parent::hydrate($data, new HostEntity());
        
        $object->setHostEntity($hostEntity);
        
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
        if (! $object instanceof WorkorderHostEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['host_entity']);
        
        return $data;
    }
}

