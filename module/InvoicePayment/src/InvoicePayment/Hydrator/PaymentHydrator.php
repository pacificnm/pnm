<?php
namespace InvoicePayment\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use InvoicePayment\Entity\PaymentEntity;
use PaymentOption\Entity\OptionEntity;

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
    
        parent::hydrate($data, $object);
    
        $optionEntity = parent::hydrate($data, new OptionEntity());
        
        $object->setOptionEntity($optionEntity);
        
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
    
        unset($data['option_entity']);
        
        return $data;
    }
}

?>