<?php
namespace VendorBill\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use VendorBill\Hydrator\BillHydrator;
use VendorBill\Entity\BillEntity;

class BillForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     * @return \VendorBill\Form\BillForm
     */
    function __construct($name = 'vendor-bill-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new BillHydrator(false));
        
        $this->setObject(new BillEntity());
        
        // vendorBillId
        $this->add(array(
            'name' => 'vendorBillId',
            'type' => 'hidden'
        ));
        
        // vendorId
        $this->add(array(
            'name' => 'vendorId',
            'type' => 'hidden'
        ));
        
        // vendorBillDateCreate
        $this->add(array(
            'name' => 'vendorBillDateCreate',
            'type' => 'hidden'
        ));
        
        // vendorBillDateDue
        $this->add(array(
            'name' => 'vendorBillDateDue',
            'type' => 'Text',
            'options' => array(
                'label' => 'Due Date:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorBillDateDue'
            )
        ));
        
        // vendorBillDatePaid
        $this->add(array(
            'name' => 'vendorBillDatePaid',
            'type' => 'hidden'
        ));
        
        // vendorBillAmount
        $this->add(array(
            'name' => 'vendorBillAmount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Amount Due:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorBillAmount'
            )
        ));
        
        // vendorBillMemo
        $this->add(array(
            'name' => 'vendorBillMemo',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Memo:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorBillMemo'
            )
        ));
        
        // vendorBillBalance
        $this->add(array(
            'name' => 'vendorBillBalance',
            'type' => 'hidden'
        ));
        
        // vendorBillStatus
        $this->add(array(
            'name' => 'vendorBillStatus',
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
            // vendorBillId
            'vendorBillId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Bill Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorId
            'vendorId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorBillDateCreate
            'vendorBillDateCreate' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Bill Create Date is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorBillDateDue
            'vendorBillDateDue' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Bill Due Date is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorBillDatePaid
            'vendorBillDatePaid' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Bill Date Paid is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorBillAmount
            'vendorBillAmount' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Bill Amount is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorBillBalance
            'vendorBillBalance' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Bill Balance is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorBillMemo
            'vendorBillMemo' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Bill Memo is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorBillStatus
            'vendorBillStatus' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Bill Status is required and cannot be empty."
                            )
                        )
                    )
                )
            )
        );
    }
}
