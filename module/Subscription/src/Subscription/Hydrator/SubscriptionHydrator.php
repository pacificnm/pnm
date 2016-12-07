<?php
namespace Subscription\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Subscription\Entity\SubscriptionEntity;
use SubscriptionSchedule\Entity\SubscriptionScheduleEntity;
use SubscriptionStatus\Entity\SubscriptionStatusEntity;
use PaymentOption\Entity\OptionEntity;
use Client\Entity\ClientEntity;

class SubscriptionHydrator extends ClassMethods
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
        if (! $object instanceof SubscriptionEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $subscriptionScheduleEntity = parent::hydrate($data, new SubscriptionScheduleEntity());
        
        $object->setSubscriptionScheduleEntity($subscriptionScheduleEntity);
        
        // status entity
        $subscriptionStatusEntity = parent::hydrate($data, new SubscriptionStatusEntity());
        
        $object->setSubscriptionStatusEntity($subscriptionStatusEntity);
        
        // payment option
        $paymentOptionEntity = parent::hydrate($data, new OptionEntity());
        
        $object->setPaymentOptionEntity($paymentOptionEntity);
        
        // client
        $clientEntity = parent::hydrate($data, new ClientEntity());
        
        $object->setClientEntity($clientEntity);
        
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
        if (! $object instanceof SubscriptionEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['payment_option_entity']);
        
        unset($data['subscription_status_entity']);
        
        unset($data['subscription_schedule_entity']);
        
        unset($data['client_entity']);
        return $data;
    }
}