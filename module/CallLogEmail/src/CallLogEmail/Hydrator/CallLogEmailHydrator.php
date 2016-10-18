<?php
namespace CallLogEmail\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use CallLogEmail\Entity\CallLogEmailEntity;

class CallLogEmailHydrator extends ClassMethods
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
        if (! $object instanceof CallLogEmailEntity) {
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
        if (! $object instanceof CallLogEmailEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['email_entity']);
        
        unset($data['log_entity']);
        
        return $data;
    }
}
