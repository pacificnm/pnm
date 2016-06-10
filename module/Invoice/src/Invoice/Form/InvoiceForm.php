<?php
namespace Invoice\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Invoice\Hydrator\InvoiceHydrator;
use Invoice\Entity\InvoiceEntity;

class InvoiceForm extends Form implements InputFilterProviderInterface
{

    function __construct($name = 'invoice-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new InvoiceHydrator(false));
        
        $this->setObject(new InvoiceEntity());
        
        // invoiceId
        $this->add(array(
            'name' => 'invoiceId',
            'type' => 'hidden'
        ));
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden'
        ));
        
        // invoiceDate
        $this->add(array(
            'name' => 'invoiceDate',
            'type' => 'Text',
            'options' => array(
                'label' => 'Date:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceDate'
            )
        ));
        
        // invoiceDateStart
        $this->add(array(
            'name' => 'invoiceDateStart',
            'type' => 'Text',
            'options' => array(
                'label' => 'Period Start:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceDateStart'
            )
        ));
        
        // invoiceDateEnd
        $this->add(array(
            'name' => 'invoiceDateEnd',
            'type' => 'Text',
            'options' => array(
                'label' => 'Period End:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceDateEnd'
            )
        ));
        
        // invoiceSubtotal
        $this->add(array(
            'name' => 'invoiceSubtotal',
            'type' => 'Text',
            'options' => array(
                'label' => 'Sub Total:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceSubtotal'
            )
        ));
        
        // invoiceTax
        $this->add(array(
            'name' => 'invoiceTax',
            'type' => 'Text',
            'options' => array(
                'label' => 'Tax:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceTax'
            )
        ));
        
        // invoiceDiscount
        $this->add(array(
            'name' => 'invoiceDiscount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Discount:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceDiscount'
            )
        ));
        
        // invoiceTotal
        $this->add(array(
            'name' => 'invoiceTotal',
            'type' => 'Text',
            'options' => array(
                'label' => 'Total:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceTotal'
            )
        ));
        
        // invoicePayment
        $this->add(array(
            'name' => 'invoicePayment',
            'type' => 'Text',
            'options' => array(
                'label' => 'Payment:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoicePayment'
            )
        ));
        
        // invoiceBalance
        $this->add(array(
            'name' => 'invoiceBalance',
            'type' => 'Text',
            'options' => array(
                'label' => 'Balance:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceBalance'
            )
        ));
        
        // invoiceStatus
        $this->add(array(
            'type' => 'Select',
            'name' => 'invoiceStatus',
            'options' => array(
                'label' => 'Status:',
                'value_options' => array(
                    'Paid' => 'Paid',
                    'Un-Paid' => 'Un-Paid',
                    'Void' => 'Void'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceStatus'
            )
        ));
        
        // invoiceDatePaid
        $this->add(array(
            'name' => 'invoiceDatePaid',
            'type' => 'hidden'
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
     *
     * {@inheritDoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // invoiceId
            'invoiceId' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // clientId
            'clientId' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Client Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceDate
            'invoiceDate' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Date is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceDateStart
            'invoiceDateStart' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Period Start is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceDateEnd
            'invoiceDateEnd' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Period End is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceSubtotal
            'invoiceSubtotal' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Sub Total is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceTax
            'invoiceTax' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Tax is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceDiscount
            'invoiceDiscount' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Discount is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceTotal
            'invoiceTotal' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Total is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoicePayment
            'invoicePayment' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Payment is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceBalance
            'invoiceBalance' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Balance is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceStatus
            'invoiceStatus' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Status is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceDatePaid
            'invoiceDatePaid' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Date Paid is required and cannot be empty."
                            )
                        )
                    )
                )
            )
        )
        ;
    }
}