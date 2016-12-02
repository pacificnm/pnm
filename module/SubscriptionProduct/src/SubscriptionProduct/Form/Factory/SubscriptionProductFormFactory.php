<?php
namespace SubscriptionProduct\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use SubscriptionProduct\Form\SubscriptionProductForm;

class SubscriptionProductFormFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \SubscriptionProduct\Form\SubscriptionProductForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $productService = $serviceLocator->get('Product\Service\ProductServiceInterface');
        
        return new SubscriptionProductForm($productService);
    }
}

