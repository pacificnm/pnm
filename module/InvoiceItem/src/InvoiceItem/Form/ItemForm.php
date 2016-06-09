<?php
namespace InvoiceItem\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use InvoiceItem\Hydrator\ItemHydrator;
use InvoiceItem\Entity\ItemEntity;

class ItemForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     */
    function __construct($name = 'item-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new ItemHydrator(false));
        
        $this->setObject(new ItemEntity());
        
        // invoiceItemId
        $this->add(array(
            'name' => 'invoiceItemId',
            'type' => 'hidden'
        ));
        
        // invoiceId
        $this->add(array(
            'name' => 'invoiceId',
            'type' => 'hidden'
        ));
        
        // invoiceItemQty
        $this->add(array(
            'name' => 'invoiceItemQty',
            'type' => 'Text',
            'options' => array(
                'label' => 'Qty:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceItemQty'
            )
        ));
        
        // invoiceItemDescrip
        $this->add(array(
            'name' => 'invoiceItemDescrip',
            'type' => 'Text',
            'options' => array(
                'label' => 'Description:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceItemDescrip'
            )
        ));
        
        // invoiceItemAmount
        $this->add(array(
            'name' => 'invoiceItemAmount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Amount:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoiceItemAmount'
            )
        ));
        
        // invoiceItemTotal
        $this->add(array(
            'name' => 'invoiceItemTotal',
            'type' => 'hidden'
        ));
        
        // invoiceItemDate
        $this->add(array(
            'name' => 'invoiceItemDate',
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
            // invoiceItemId
            'invoiceItemId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Item Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceId
            'invoiceItemId' => array(
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
            
            // invoiceItemQty
            'invoiceItemQty' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Qty is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceItemDescrip
            'invoiceItemDescrip' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Description is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceItemAmount
            'invoiceItemAmount' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Amount is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceItemTotal
            'invoiceItemTotal' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Total is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoiceItemDate
            'invoiceItemDate' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Date is required and cannot be empty."
                            )
                        )
                    )
                )
            )
        );
    }
}