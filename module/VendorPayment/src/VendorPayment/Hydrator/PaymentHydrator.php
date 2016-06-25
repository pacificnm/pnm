<?php
namespace VendorPayment\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use VendorPayment\Entity\PaymentEntity;
use Account\Entity\AccountEntity;

class PaymentHydrator extends ClassMethods
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
        if (! $object instanceof PaymentEntity) {
            return $object;
        }
        
        $accountEntity = parent::hydrate($data, new AccountEntity());
        
        $object->setAccountEntity($accountEntity);
        
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
        if (! $object instanceof PaymentEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['account_entity']);
        return $data;
    }
}