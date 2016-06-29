<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Account\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Account\Hydrator\AccountHydrator;
use Account\Entity\AccountEntity;
use AccountType\Service\TypeServiceInterface;

/**
 *
 * @author jaimie
 *
 */
class AccountForm extends Form implements InputFilterProviderInterface
{
    
    /**
     * 
     * @var TypeServiceInterface
     */
    protected $typeService;
    
    /**
     * 
     * @param TypeServiceInterface $typeService
     * @param string $name
     * @param array $options
     * @return \Account\Form\AccountForm
     */
    function __construct(TypeServiceInterface $typeService, $name = 'account-type-form', $options = array())
    {
        $this->typeService = $typeService;
    
        parent::__construct($name, $options);
    
        $this->setHydrator(new AccountHydrator(false));
    
        $this->setObject(new AccountEntity());
        
        // accountId
        $this->add(array(
            'name' => 'accountId',
            'type' => 'hidden'
        ));
        
        // accountTypeId
        $this->add(array(
            'type' => 'Select',
            'name' => 'accountTypeId',
            'options' => array(
                'label' => 'Type:',
                'value_options' => $this->getAccountTypeOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'accountTypeId'
            )
        ));
        
        // accountName
        $this->add(array(
            'name' => 'accountName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'accountName'
            )
        ));
        
        // accountDescription
        $this->add(array(
            'name' => 'accountDescription',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Description:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'accountDescription'
            )
        ));
        
        // accountNumber
        $this->add(array(
            'name' => 'accountNumber',
            'type' => 'Text',
            'options' => array(
                'label' => 'Account Number:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'accountNumber'
            )
        ));
        
        // accountBalance
        $this->add(array(
            'name' => 'accountBalance',
            'type' => 'Text',
            'options' => array(
                'label' => 'Account Balance:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'accountBalance'
            )
        ));
        
        // accountCreated
        $this->add(array(
            'name' => 'accountCreated',
            'type' => 'hidden'
        ));
        
        // accountActive
        $this->add(array(
            'name' => 'accountActive',
            'type' => 'hidden'
        ));
        
        // accountVisible
        $this->add(array(
            'name' => 'accountVisible',
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
            // accountId
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Account Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // accountTypeId
            'accountTypeId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Account Type Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // accountName
            'accountName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Account Name is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // accountDescription
            'accountName' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
            ),
            
            // accountNumber
            'accountName' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
            ),
            
            // accountBalance
            'accountBalance' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Account Balance is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // accountCreated
            'accountCreated' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Account Create Date is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // accountActive
            'accountActive' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Account Active is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            // accountVisible
            'accountVisible' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Account Visible is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
        );
        
    }

    public function getAccountTypeOptions()
    {
        $options = array();
        
        $entitys = $this->typeService->getAll(array());
        
        foreach($entitys as $entity) {
            $options[$entity->getAccountTypeId()] = $entity->getAccountTypeName();
        }
        
        return $options;
    }
}
