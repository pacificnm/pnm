<?php
namespace AccountType\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use AccountType\Entity\TypeEntity;
use AccountType\Hydrator\TypeHydrator;
use Zend\Db\Adapter\AdapterInterface;

class TypeForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @var AdapterInterface
     */
    protected $readAdapter;
    
    /**
     * 
     * @param AdapterInterface $readAdapter
     * @param string $name
     * @param array $options
     */
    function __construct(AdapterInterface $readAdapter, $name = 'account-type-form', $options = array())
    {
        $this->readAdapter = $readAdapter;
        
        parent::__construct($name, $options);
    
        $this->setHydrator(new TypeHydrator(false));
    
        $this->setObject(new TypeEntity());
    
        // accountTypeId
        $this->add(array(
            'name' => 'accountTypeId',
            'type' => 'hidden'
        ));
        
        // accountTypeName
        $this->add(array(
            'name' => 'accountTypeName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'laborName'
            )
        ));
        
        // accountTypeActive
        $this->add(array(
            'name' => 'accountTypeActive',
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
            
            // accountTypeName
            'accountTypeName' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Account Type Name is required and cannot be empty."
                            )
                        )
                    ),
                    
                )
            ),
            
            // accountTypeActive
            'accountTypeActive' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Account Type Active is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
        
    }

}