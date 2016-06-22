<?php
namespace Vendor\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Vendor\Hydrator\VendorHydrator;
use Vendor\Entity\VendorEntity;

class VendorForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     * @return \Phone\Form\PhoneForm
     */
    function __construct($name = 'phone-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new VendorHydrator(false));
        
        $this->setObject(new VendorEntity());
        
        // vendorId
        $this->add(array(
            'name' => 'vendorId',
            'type' => 'hidden'
        ));
        
        // vendorName
        $this->add(array(
            'name' => 'vendorName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorName'
            )
        ));
        
        // vendorAccountNumber
        $this->add(array(
            'name' => 'vendorAccountNumber',
            'type' => 'Text',
            'options' => array(
                'label' => 'Account Number:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'phoneNum'
            )
        ));
        
        // vendorStreet
        $this->add(array(
            'name' => 'vendorStreet',
            'type' => 'Text',
            'options' => array(
                'label' => 'Street:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorStreet'
            )
        ));
        
        // vendorStreetCont
        $this->add(array(
            'name' => 'vendorStreetCont',
            'type' => 'Text',
            'options' => array(
                'label' => 'Street Cont:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorStreetCont'
            )
        ));
        
        // vendorCity
        $this->add(array(
            'name' => 'vendorCity',
            'type' => 'Text',
            'options' => array(
                'label' => 'City:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorCity'
            )
        ));
        
        // vendorState
        $this->add(array(
            'name' => 'vendorState',
            'type' => 'Text',
            'options' => array(
                'label' => 'State:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorState'
            )
        ));
        
        // vendorPostal
        $this->add(array(
            'name' => 'vendorPostal',
            'type' => 'Text',
            'options' => array(
                'label' => 'Postal Code:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorPostal'
            )
        ));
        
        // vendorPhone
        $this->add(array(
            'name' => 'vendorPhone',
            'type' => 'Text',
            'options' => array(
                'label' => 'Phone Number:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorPhone'
            )
        ));
        
        // vendorWebsite
        $this->add(array(
            'name' => 'vendorWebsite',
            'type' => 'Text',
            'options' => array(
                'label' => 'Website:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'vendorWebsite'
            )
        ));
        
        // vendorActive
        $this->add(array(
            'name' => 'vendorActive',
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
            
            // vendorName
            'vendorName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorAccountNumber
            'vendorAccountNumber' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Account Number is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorStreet
            'vendorStreet' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Street is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorStreetCont
            'vendorStreet' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                )
            ),
            
            // vendorCity
            'vendorCity' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor City is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorState
            'vendorState' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor State is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorPostal
            'vendorPostal' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Postal is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // vendorPhone
            'vendorPhone' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Phone is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            
            // vendorWebsite
            'vendorWebsite' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                )
            ),
            
            // vendorActive
            'vendorActive' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Vendor Active Flag is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
    }
}