<?php
namespace Subscription\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Subscription\Entity\SubscriptionEntity;
use SubscriptionSchedule\Entity\SubscriptionScheduleEntity;
use Product\Entity\ProductEntity;
use SubscriptionStatus\Entity\SubscriptionStatusEntity;
use PaymentOption\Entity\OptionEntity;

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
     * {@inheritDoc}
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
        
        // product Entity
        $productEntity = parent::hydrate($data, new ProductEntity());
        
        $object->setProductEntity($productEntity);
        
        // status entity
        $subscriptionStatusEntity = parent::hydrate($data, new SubscriptionStatusEntity());
        
        $object->setSubscriptionStatusEntity($subscriptionStatusEntity);
        
        // payment option
        $paymentOptionEntity = parent::hydrate($data, new OptionEntity());
        
        $object->setPaymentOptionEntity($paymentOptionEntity);
        
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
        if (! $object instanceof SubscriptionEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['payment_option_entity']);
        
        unset($data['product_entity']);
        
        unset($data['next_product_entity']);
        
        unset($data['subscription_status_entity']);
        
        unset($data['subscription_schedule_entity']);
        
        return $data;
    }
}