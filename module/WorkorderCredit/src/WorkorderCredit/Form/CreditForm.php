<?php
namespace WorkorderCredit\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use WorkorderCredit\Entity\CreditEntity;
use WorkorderCredit\Hydrator\CreditHydrator;
use PaymentOption\Service\OptionServiceInterface;

class CreditForm extends Form implements InputFilterProviderInterface
{
    /**
     *
     * @var OptionServiceInterface
     */
    protected $optionService;
    
    /**
     * 
     * @param OptionServiceInterface $optionService
     * @param string $name
     * @param array $options
     */
    function __construct(OptionServiceInterface $optionService, $name = 'workorder-credit-form', $options = array())
    {
        $this->optionService = $optionService;
    
        parent::__construct($name, $options);
    
        $this->setHydrator(new CreditHydrator(false));
    
        $this->setObject(new CreditEntity());
    
        // workorderCreditId
        $this->add(array(
            'name' => 'workorderCreditId',
            'type' => 'hidden'
        ));
        
        // workorderId
        $this->add(array(
            'name' => 'workorderId',
            'type' => 'hidden'
        ));
        
        // workorderCreditAmount
        $this->add(array(
            'name' => 'workorderCreditAmount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Amount:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderCreditAmount',
                'required' => true
            )
        ));
        
        
        // workorderCreditAmountLeft
        $this->add(array(
            'name' => 'workorderCreditAmountLeft',
            'type' => 'hidden'
        ));
        
        // paymentOptionId
        $this->add(array(
            'type' => 'Select',
            'name' => 'paymentOptionId',
            'options' => array(
                'label' => 'Payment Method:',
                'value_options' => $this->getSelectOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'paymentOptionId'
            )
        ));
        
        // workorderCreditType
        $this->add(array(
            'type' => 'Select',
            'name' => 'workorderCreditType',
            'options' => array(
                'label' => 'Credit Type:',
                'value_options' => array(
                    'Labor' => 'Labor',
                    'Parts' => 'Parts',
                    'Total' => 'Total'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderCreditType'
            )
        ));
        
        // workorderCreditDetail
        $this->add(array(
            'name' => 'workorderCreditDetail',
            'type' => 'Text',
            'options' => array(
                'label' => 'Detail:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderCreditDetail',
                'required' => true
            )
        ));
        
        // workorderCreditDate
        $this->add(array(
            'name' => 'workorderCreditDate',
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
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // workorderCreditId
            'workorderCreditId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Credit Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderId
            'workorderId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            
            // workorderCreditAmount
            'workorderCreditAmount' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Credit Amount is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderCreditAmountLeft
            'workorderCreditAmountLeft' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Credit Amount Left is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // paymentOptionId
            'paymentOptionId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Payment Option is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderCreditDetail
            'workorderCreditDetail' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Credit Detail is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // workorderCreditDate
            'workorderCreditDate' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Work Order Credit Date is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
        
    }
    
    /**
     *
     * @return array
     */
    private function getSelectOptions()
    {
        $options = array();
    
        $optionEntitys = $this->optionService->getActive();
    
        foreach ($optionEntitys as $optionEntity) {
            $options[$optionEntity->getPaymentOptionId()] = $optionEntity->getPaymentOptionName();
        }
    
        return $options;
    }

}