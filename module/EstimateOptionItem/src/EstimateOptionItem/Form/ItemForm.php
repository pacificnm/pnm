<?php
namespace EstimateOptionItem\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use EstimateOptionItem\Hydrator\ItemHydrator;
use EstimateOptionItem\Entity\ItemEntity;

class ItemForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     * @return \EstimateOptionItem\Form\ItemForm
     */
    public function __construct($name = 'estimate-option-item-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new ItemHydrator(false));
        
        $this->setObject(new ItemEntity());
        
        // estimateOptionItemId
        $this->add(array(
            'name' => 'estimateOptionItemId',
            'type' => 'hidden'
        ));
        
        // estimateOptionId
        $this->add(array(
            'name' => 'estimateOptionId',
            'type' => 'hidden'
        ));
        
        // estimateOptionItemQty
        $this->add(array(
            'name' => 'estimateOptionItemQty',
            'type' => 'Text',
            'options' => array(
                'label' => 'Quantity:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'estimateOptionItemQty'
            )
        ));
        
        // estimateOptionTitle
        $this->add(array(
            'name' => 'estimateOptionTitle',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'estimateOptionTitle'
            )
        ));
        
        // estimateOptionItemType
        $this->add(array(
            'type' => 'Select',
            'name' => 'estimateOptionItemType',
            'options' => array(
                'label' => 'Type:',
                'value_options' => array(
                    'Labor' => 'Labor',
                    'Part' => 'Part'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'estimateOptionItemType'
            )
        ));
        
        // estimateOptionItemAmount
        $this->add(array(
            'name' => 'estimateOptionItemAmount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Amount:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'estimateOptionItemAmount'
            )
        ));
        
        // estimateOptionItemTotal
        $this->add(array(
            'name' => 'estimateOptionItemTotal',
            'type' => 'hidden'
        ));
        
        // estimateOptionItemDescription
        $this->add(array(
            'name' => 'estimateOptionItemDescription',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Description:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'estimateOptionItemDescription'
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
     *
     * {@inheritDoc}
     *
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // estimateOptionItemId
            'estimateOptionItemId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Estimate Option Item Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // estimateOptionId
            'estimateOptionId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Estimate Option Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // estimateOptionItemQty
            'estimateOptionItemQty' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Quantity is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // estimateOptionTitle
            'estimateOptionTitle' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Title is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // estimateOptionItemType
            'estimateOptionItemType' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Type is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // estimateOptionItemAmount
            'estimateOptionItemAmount' => array(
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
            
            // estimateOptionItemTotal
            'estimateOptionItemTotal' => array(
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
            
            // estimateOptionItemDescription
            'estimateOptionItemDescription' => array(
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
            )
        );
    }
}
