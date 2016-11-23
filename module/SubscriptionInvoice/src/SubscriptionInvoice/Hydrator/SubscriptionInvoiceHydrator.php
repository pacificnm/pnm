<?php
namespace SubscriptionInvoice\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use SubscriptionInvoice\Entity\SubscriptionInvoiceEntity;
use Subscription\Entity\SubscriptionEntity;
use Invoice\Entity\InvoiceEntity;

class SubscriptionInvoiceHydrator extends ClassMethods
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
        if (! $object instanceof SubscriptionInvoiceEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $subscriptionEntity = parent::hydrate($data, new SubscriptionEntity());
        
        $object->setSubscriptionEntity($subscriptionEntity);
        
        $invoiceEntity = parent::hydrate($data, new InvoiceEntity());
        
        $object->setInvoiceEntity($invoiceEntity);
        
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
        if (! $object instanceof SubscriptionInvoiceEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['invoice_entity']);
        
        unset($data['subscription_entity']);
        
        return $data;
    }
}
