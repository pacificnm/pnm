<?php
namespace Product\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Product\Hydrator\ProductHydrator;
use Product\Entity\ProductEntity;

class ProductForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     */
    public function __construct($name = 'product-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new ProductHydrator(false));
        
        $this->setObject(new ProductEntity());
        
        // productId
        $this->add(array(
            'name' => 'productId',
            'type' => 'hidden'
        ));
        
        // productName
        $this->add(array(
            'name' => 'productName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'productName'
            )
        ));
        
        // productDescriptionShort
        $this->add(array(
            'name' => 'productDescriptionShort',
            'type' => 'Text',
            'options' => array(
                'label' => 'Short Description:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'productDescriptionShort'
            )
        ));
        
        // productDescriptionLong
        $this->add(array(
            'name' => 'productDescriptionLong',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Description:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'productDescriptionLong'
            )
        ));
        
        // productFee
        $this->add(array(
            'name' => 'productFee',
            'type' => 'Text',
            'options' => array(
                'label' => 'One Time Fee:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'productFee',
                'value' => '0.00'
            )
        ));
        
        // productFeeSetup
        $this->add(array(
            'name' => 'productFeeSetup',
            'type' => 'Text',
            'options' => array(
                'label' => 'Set Up Fee:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'productFeeSetup',
                'value' => '0.00'
            )
        ));
        
        // productFeeMonthly
        $this->add(array(
            'name' => 'productFeeMonthly',
            'type' => 'Text',
            'options' => array(
                'label' => 'Monthly Fee:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'productFeeMonthly',
                'value' => '0.00'
            )
        ));
        
        // productFeeAnual
        $this->add(array(
            'name' => 'productFeeAnual',
            'type' => 'Text',
            'options' => array(
                'label' => 'Anual Fee:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'productFeeAnual',
                'value' => '0.00'
            )
        ));
        
        // productImage
        $this->add(array(
            'name' => 'productImage',
            'type' => 'Text',
            'options' => array(
                'label' => 'Product Image:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'productImage'
            )
        ));
        
        // productStatus
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'productStatus',
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
     *
     * {@inheritDoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        // TODO Auto-generated method stub
    }
}
