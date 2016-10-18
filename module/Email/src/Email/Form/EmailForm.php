<?php
namespace Email\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Email\Hydrator\EmailHydrator;
use Email\Entity\EmailEntity;

class EmailForm extends Form implements InputFilterProviderInterface
{

    /**
     * 
     * @param string $name
     * @param array $options
     * @return \Email\Form\EmailForm
     */
    function __construct($name, $options)
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new EmailHydrator(false));
        
        $this->setObject(new EmailEntity());
        
        // emailId
        $this->add(array(
            'name' => 'emailId',
            'type' => 'hidden'
        ));
        
        // authId
        $this->add(array(
            'name' => 'authId',
            'type' => 'hidden'
        ));
        
        // emailDateCreated
        $this->add(array(
            'name' => 'emailDateCreated',
            'type' => 'hidden'
        ));
        
        // emailDateSent
        $this->add(array(
            'name' => 'emailDateSent',
            'type' => 'hidden'
        ));
        
        // emailToAddress
        $this->add(array(
            'name' => 'emailToAddress',
            'type' => 'Text',
            'options' => array(
                'label' => 'To Address:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'emailToAddress'
            )
        ));
        
        // emailToName
        $this->add(array(
            'name' => 'emailToName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'emailToName'
            )
        ));
        
        // emailFromAddress
        $this->add(array(
            'name' => 'emailFromAddress',
            'type' => 'Text',
            'options' => array(
                'label' => 'From Address:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'emailFromAddress'
            )
        ));
        
        // emailFromName
        $this->add(array(
            'name' => 'emailFromName',
            'type' => 'Text',
            'options' => array(
                'label' => 'From Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'configCopyYear'
            )
        ));
        
        // emailSubject
        $this->add(array(
            'name' => 'emailSubject',
            'type' => 'Text',
            'options' => array(
                'label' => 'Subject:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'emailSubject'
            )
        ));
        
        // emailBody
        $this->add(array(
            'name' => 'emailBody',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Body:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'emailBody'
            )
        ));
        
        // emailLog
        $this->add(array(
            'name' => 'emailLog',
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
            // emailId
            
            // authId
            
            // emailDateCreated
            
            // emailDateSent
            
            // emailToAddress
            
            // emailToName
            
            // emailFromAddress
            
            // emailFromName
            
            // emailSubject
            
            // emailBody
            
            // emailLog
        );
    }
}