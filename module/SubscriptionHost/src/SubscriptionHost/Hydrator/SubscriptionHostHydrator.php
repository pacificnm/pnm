<?php
namespace SubscriptionHost\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use SubscriptionHost\Entity\SubscriptionHostEntity;
use Host\Entity\HostEntity;
use Subscription\Entity\SubscriptionEntity;
use HostType\Entity\TypeEntity;

class SubscriptionHostHydrator extends ClassMethods
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
        if (! $object instanceof SubscriptionHostEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $hostEntity = parent::hydrate($data, new HostEntity());
        
        $object->setHostEntity($hostEntity);
        
        $typeEntity = parent::hydrate($data, new TypeEntity());
        
        $object->getHostEntity()->setTypeEntity($typeEntity);
        
        $subscriptionEntity = parent::hydrate($data, new SubscriptionEntity());
        
        $object->setSubscriptionEntity($subscriptionEntity);
        
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
        if (! $object instanceof SubscriptionHostEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['host_entity']);
        
        unset($data['subscription_entity']);
        
        return $data;
    }
}
