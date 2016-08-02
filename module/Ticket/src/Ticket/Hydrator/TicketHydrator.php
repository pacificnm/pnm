<?php
namespace Ticket\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Ticket\Entity\TicketEntity;
use User\Entity\UserEntity;

class TicketHydrator extends ClassMethods
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
        if (! $object instanceof TicketEntity) {
            return $object;
        }
    
        parent::hydrate($data, $object);
    
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
        if (! $object instanceof TicketEntity) {
            return $object;
        }
    
        $data = parent::extract($object);
    
        unset($data['user_entity']);
        
        return $data;
    }
}

