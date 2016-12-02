<?php
namespace SubscriptionProduct\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use Product\Entity\ProductEntity;
use SubscriptionProduct\Entity\SubscriptionProductEntity;

class SubscriptionProductHydrator extends ClassMethods
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
        if (! $object instanceof SubscriptionProductEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $productEntity = parent::hydrate($data, new ProductEntity());
        
        $object->setProductEntity($productEntity);
        
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
        if (! $object instanceof SubscriptionProductEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['product_entity']);
        
        return $data;
    }
}

