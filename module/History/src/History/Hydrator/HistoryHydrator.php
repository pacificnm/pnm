<?php
namespace History\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use History\Entity\HistoryEntity;
use Auth\Entity\AuthEntity;

class HistoryHydrator extends ClassMethods
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
        if (! $object instanceof HistoryEntity) {
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
        if (! $object instanceof HistoryEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['auth_entity']);
        
        return $data;
    }
}