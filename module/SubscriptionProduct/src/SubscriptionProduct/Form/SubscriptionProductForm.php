<?php
namespace SubscriptionProduct\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Product\Service\ProductServiceInterface;
use SubscriptionProduct\Hydrator\SubscriptionProductHydrator;
use SubscriptionProduct\Entity\SubscriptionProductEntity;

class SubscriptionProductForm  extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @var ProductServiceInterface
     */
    protected $productService;
    
    /**
     * 
     * @param ProductServiceInterface $productService
     * @param string $name
     * @param array $options
     */
    public function __construct(ProductServiceInterface $productService, $name = 'subscription-product-form', $options = array())
    {
        $this->productService = $productService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new SubscriptionProductHydrator(false));
        
        $this->setObject(new SubscriptionProductEntity());
        
        // subscriptionProductId
        $this->add(array(
            'name' => 'subscriptionProductId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'subscriptionProductId'
            )
        ));
        
        // subscriptionId
        $this->add(array(
            'name' => 'subscriptionId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'subscriptionId'
            )
        ));
        
        // subscriptionProductQty
        $this->add(array(
            'name' => 'subscriptionProductQty',
            'type' => 'Text',
            'options' => array(
                'label' => 'Quantity:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'subscriptionProductQty'
            )
        ));
        
        // productId
        $this->add(array(
            'name' => 'productId',
            'type' => 'select',
            'options' => array(
                'label' => 'Product:',
                'value_options' => $this->getProductOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'productId'
            )
        ));
        
        // subscriptionProductStatus
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'subscriptionProductStatus',
            'attributes' => array(
                'id' => 'subscriptionProductStatus',
                'value' => 1
            ),
            'options' => array(
                'label' => 'Enabled',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));
        
        // submit button
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
    }
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            
        );
        
    }

    /**
     * 
     * @return \Product\Entity\the[]
     */
    protected function getProductOptions()
    {
        $entitys = $this->productService->getAll(array('pagination' => 'off'));
        
        $options = array();
        
        foreach ($entitys as $entity) {
            $options[$entity->getProductId()] = $entity->getProductName();
        }
        
        return $options;
    }
}

