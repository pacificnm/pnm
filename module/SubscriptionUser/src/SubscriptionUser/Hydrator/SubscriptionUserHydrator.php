<?php
namespace SubscriptionUser\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use SubscriptionUser\Entity\SubscriptionUserEntity;
use User\Entity\UserEntity;
use Subscription\Entity\SubscriptionEntity;

class SubscriptionUserHydrator extends ClassMethods
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
        if (! $object instanceof SubscriptionUserEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $userEntity = parent::hydrate($data, new UserEntity());
        
        $object->setUserEntity($userEntity);
        
        $subscriptionEntity = parent::hydrate($data, new SubscriptionEntity());
        
        $object->setSubscriptionEntity($subscriptionEntity);
        
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
        if (! $object instanceof SubscriptionUserEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['user_entity']);
        
        unset($data['subscription_entity']);
        
        return $data;
    }
}

