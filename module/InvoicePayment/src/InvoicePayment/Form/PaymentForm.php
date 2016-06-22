<?php
namespace InvoicePayment\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use InvoicePayment\Entity\PaymentEntity;
use InvoicePayment\Hydrator\PaymentHydrator;
use PaymentOption\Service\OptionServiceInterface;
use Account\Service\AccountServiceInterface;

class PaymentForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @var OptionServiceInterface
     */
    protected $optionService;

    /**
     *
     * @var AccountServiceInterface
     */
    protected $accountService;

    /**
     *
     * @param OptionServiceInterface $optionService            
     * @param AccountServiceInterface $accountService            
     * @param string $name            
     * @param array $options            
     * @return \InvoicePayment\Form\PaymentForm
     */
    function __construct(OptionServiceInterface $optionService, AccountServiceInterface $accountService, $name = 'payment-form', $options = array())
    {
        $this->optionService = $optionService;
        
        $this->accountService = $accountService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new PaymentHydrator(false));
        
        $this->setObject(new PaymentEntity());
        
        // invoicePaymentId
        $this->add(array(
            'name' => 'invoicePaymentId',
            'type' => 'hidden'
        ));
        
        // invoiceId
        $this->add(array(
            'name' => 'invoiceId',
            'type' => 'hidden'
        ));
        
        // invoicePaymentDate
        $this->add(array(
            'name' => 'invoicePaymentDate',
            'type' => 'Text',
            'options' => array(
                'label' => 'Date:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoicePaymentDate',
                'required' => true
            )
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
        
        // invoicePaymentAmount
        $this->add(array(
            'name' => 'invoicePaymentAmount',
            'type' => 'Text',
            'options' => array(
                'label' => 'Amount:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoicePaymentAmount',
                'required' => true
            )
        ));
        
        // invoicePaymentDetail
        $this->add(array(
            'name' => 'invoicePaymentDetail',
            'type' => 'Text',
            'options' => array(
                'label' => 'Detail:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'invoicePaymentDetail',
                'required' => true
            )
        ));
        
        // accountId
        $this->add(array(
            'type' => 'Select',
            'name' => 'accountId',
            'options' => array(
                'label' => 'Deposit To:',
                'value_options' => $this->getAccountOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'accountId'
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
            // invoicePaymentId
            'invoicePaymentId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Payment Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
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
            
            'accountId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Deposit To is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoicePaymentDate
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Payment Date is required and cannot be empty."
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Payment Method is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoicePaymentAmount
            'invoicePaymentAmount' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Invoice Payment Amount is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // invoicePaymentDetail
            'invoicePaymentDetail' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                )
            )
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

    /**
     *
     * @return array
     */
    private function getAccountOptions()
    {
        $options = array();
        
        $entitys = $this->accountService->getNonSystemAccounts();
        
        foreach ($entitys as $entity) {
            $options[$entity->getAccountId()] = $entity->getAccountName();
        }
        
        return $options;
    }
}