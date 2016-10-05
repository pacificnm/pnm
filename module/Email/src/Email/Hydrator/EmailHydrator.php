<?php
namespace Email\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Email\Entity\EmailEntity;

class EmailHydrator extends ClassMethods
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
        if (! $object instanceof EmailEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
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
        if (! $object instanceof EmailEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['auth_entity']);
        
        unset($data['client_entity']);
        
        return $data;
    }
}