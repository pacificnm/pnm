<?php
namespace Account\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Account\Entity\AccountEntity;
use AccountType\Entity\TypeEntity;

class AccountHydrator extends Classmethods
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
        if (! $object instanceof AccountEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $typeEntity = parent::hydrate($data, new TypeEntity());
        
        $object->setTypeEntity($typeEntity);
        
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
        if (! $object instanceof AccountEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['type_entity']);
        
        return $data;
    }
}