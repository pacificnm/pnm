<?php
namespace HostAttributeValue\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use HostAttributeValue\Hydrator\ValueHydrator;
use HostAttributeValue\Entity\ValueEntity;

class ValueForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @param string $name
     * @param array $options
     * @return \HostAttributeValue\Form\ValueForm
     */
    function __construct($name = 'host-attribute-value-form', $options = array())
    {
        parent::__construct($name, $options);
    
        $this->setHydrator(new ValueHydrator(false));
    
        $this->setObject(new ValueEntity());
    
        // hostAttributeValueId
        $this->add(array(
            'name' => 'hostAttributeValueId',
            'type' => 'hidden'
        ));
        
        $this->add(array(
            'name' => 'hostAttributeValueId',
            'type' => 'hidden'
        ));
        
        //hostAttributeValueName
        $this->add(array(
            'name' => 'hostAttributeValueName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Value:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'hostAttributeName'
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
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array();
        
    }

}