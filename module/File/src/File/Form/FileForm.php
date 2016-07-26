<?php
namespace File\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use File\Entity\FileEntity;
use File\Hydrator\FileHydrator;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\FileInput;

class FileForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @param string $name            
     * @param array $options            
     * @return \File\Form\FileForm
     */
    function __construct($name = 'file-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new FileHydrator(false));
        
        $this->setObject(new FileEntity());
        
        // fileId
        $this->add(array(
            'name' => 'fileId',
            'type' => 'hidden'
        ));
        
        // authId
        $this->add(array(
            'name' => 'authId',
            'type' => 'hidden'
        ));
        
        // fileTitle
        $this->add(array(
            'name' => 'fileTitle',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'fileTitle'
            )
        ));
        
        // fileName
        $this->add(array(
            'name' => 'fileName',
            'type' => 'File',
            'options' => array(
                'label' => 'File:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'fileName'
            )
        ));
        
        // filePath
        $this->add(array(
            'name' => 'filePath',
            'type' => 'hidden'
        ));
        
        // fileMime
        $this->add(array(
            'name' => 'fileMime',
            'type' => 'hidden'
        ));
        
        // fileSize
        $this->add(array(
            'name' => 'fileSize',
            'type' => 'hidden'
        ));
        
        // fileCreate
        $this->add(array(
            'name' => 'fileCreate',
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
        
        $this->setInputFilter($this->createInputFilter());
        
        return $this;
    }

    
    /**
     * 
     * @return \Zend\InputFilter\InputFilter
     */
    public function createInputFilter()
    {
        $inputFilter = new InputFilter();
        
        $file = new FileInput('fileName');
        
        $file->setRequired(true);
        
        $file->getFilterChain()->attachByName('filerenameupload', array(
            'target' => './data/temp/',
            'overwrite' => true,
            'use_upload_name' => true
        ));
        
        $inputFilter->add($file);
        
        return $inputFilter;
    }
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // estimateId
            'fileId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The File Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            'authId' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The Auth Id is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            'fileCreate' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The File Create is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
            
            'fileTitle' => array(
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
                                \Zend\Validator\NotEmpty::IS_EMPTY => "The File Title is required and cannot be empty."
                            )
                        )
                    )
                )
            ),
        );
        
    }

}

