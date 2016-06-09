<?php
namespace InvoiceOption\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use InvoiceOption\Hydrator\OptionHydrator;
use InvoiceOption\Entity\OptionEntity;

class OptionForm extends Form implements InputFilterProviderInterface
{
    function __construct($name = 'invoice-option-form', $options = array())
    {
    
        parent::__construct($name, $options);
    
        $this->setHydrator(new OptionHydrator(false));
    
        $this->setObject(new OptionEntity());
    
        // invoiceOptionId
        $this->add(array(
            'name' => 'invoiceOptionId',
            'type' => 'hidden'
        ));
        
        // invoiceOptionEnableTax
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'invoiceOptionEnableTax',
            'options' => array(
                'label' => 'Enable Tax',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'id' => 'invoiceOptionEnableTax'
            )
        ));
        
        // invoiceOptionEnableDiscount
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'invoiceOptionEnableDiscount',
            'options' => array(
                'label' => 'Enable Discount',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'id' => 'invoiceOptionEnableDiscount'
            )
        ));
        
        // invoiceOptionMemo
        $this->add(array(
            'name' => 'invoiceOptionMemo',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Memo:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceOptionMemo'
            )
        ));
        
        // invoiceOptionTerms
        $this->add(array(
            'name' => 'invoiceOptionTerms',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Terms:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceOptionTerms'
            )
        ));
        
        // button
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
        
        return $this;
    }
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // invoiceOptionId
            
            // invoiceOptionEnableTax
            
            // invoiceOptionEnableDiscount
            
            // invoiceOptionMemo
            
            // invoiceOptionTerms
        );
    }

}