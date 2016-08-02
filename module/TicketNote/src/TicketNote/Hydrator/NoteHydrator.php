<?php
namespace TicketNote\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use TicketNote\Entity\NoteEntity;
use Auth\Entity\AuthEntity;

class NoteHydrator extends ClassMethods
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
        if (! $object instanceof NoteEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $authEntity = parent::hydrate($data, new AuthEntity());
        
        $object->setAuthEntity($authEntity);
        
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
        if (! $object instanceof NoteEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['auth_entity']);
        
        return $data;
    }
}

