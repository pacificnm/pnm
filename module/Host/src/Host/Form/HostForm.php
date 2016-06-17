<?php
namespace Host\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Host\Hydrator\HostHydrator;
use Host\Entity\HostEntity;

class HostForm extends Form implements InputFilterProviderInterface
{
    /**
     *
     * @param string $name
     * @param array $options
     * @return \HostType\Form\TypeForm
     */
    function __construct($name = 'host-type-form', $options = array())
    {
        parent::__construct($name, $options);
    
        $this->setHydrator(new HostHydrator(false));
    
        $this->setObject(new HostEntity());
    
        // hostTypeId
        $this->add(array(
            'name' => 'hostId',
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
        // TODO Auto-generated method stub
        
    }

    
}
