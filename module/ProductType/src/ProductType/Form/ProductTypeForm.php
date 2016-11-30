<?php
namespace ProductType\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use ProductType\Hydrator\ProductTypeHydrator;
use ProductType\Entity\ProductTypeEntity;

class ProductTypeForm extends Form implements InputFilterProviderInterface
{

    /**
     * 
     * @param string $name
     * @param array $options
     */
    public function __construct($name = 'product-type-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new ProductTypeHydrator(false));
        
        $this->setObject(new ProductTypeEntity());
        
        // productTypeId
        $this->add(array(
            'name' => 'productTypeId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'productTypeId'
            )
        ));
        
        // productTypeName
        $this->add(array(
            'name' => 'productTypeName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Product Type Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'productTypeName'
            )
        ));
        
        // productTypeStatus
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'productTypeStatus',
            'attributes' => array(
                'id' => 'productTypeStatus'
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
     *
     * {@inheritdoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            
        );
    }
}

