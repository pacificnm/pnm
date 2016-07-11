<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace EstimateOption\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use EstimateOption\Hydrator\OptionHydrator;
use EstimateOption\Entity\OptionEntity;

class OptionForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @param string $name
     * @param array $options
     * @return \EstimateOption\Form\OptionForm
     */
    public function __construct($name = 'estimate-option-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new OptionHydrator(false));
        
        $this->setObject(new OptionEntity());
        
        // estimateOptionId
        $this->add(array(
            'name' => 'estimateOptionId',
            'type' => 'hidden'
        ));
        
        // estimateId
        $this->add(array(
            'name' => 'estimateId',
            'type' => 'hidden'
        ));
        
        // estimateOptionTitle
        $this->add(array(
            'name' => 'estimateOptionTitle',
            'type' => 'Text',
            'options' => array(
                'label' => 'Option Title:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'estimateOptionTitle'
            )
        ));
        
        // estimateOptionDecription
        $this->add(array(
            'name' => 'estimateOptionDecription',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Option Description:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'estimateOptionDecription'
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
            
            // estimateId
            'estimateId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Estimate Id is required and cannot be empty."
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Estimate Option Title is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // estimateOptionDecription
            'estimateOptionDecription' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Estimate Description is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
    }
}
