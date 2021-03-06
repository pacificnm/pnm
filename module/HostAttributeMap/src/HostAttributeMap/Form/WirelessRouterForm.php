<?php
namespace HostAttributeMap\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use HostAttributeValue\Service\ValueServiceInterface;

class WirelessRouterForm extends Form implements InputFilterProviderInterface
{

    /**
     *
     * @var ValueServiceInterface
     */
    protected $valueService;

    /**
     *
     * @param ValueServiceInterface $valueService            
     * @param string $name            
     * @param array $options            
     * @return \HostAttributeMap\Form\WorkstationForm
     */
    public function __construct(ValueServiceInterface $valueService, $name = 'host-attribute-map-form', $options = array())
    {
        $this->valueService = $valueService;
        
        parent::__construct($name, $options);
        
        // operatingSystemId
        $this->add(array(
            'type' => 'Select',
            'name' => 'operatingSystemId',
            'options' => array(
                'label' => 'Operating System:',
                'value_options' => $this->getOperatingSystemOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'operatingSystemId'
            )
        ));
        
        // Manufacture
        $this->add(array(
            'type' => 'Select',
            'name' => 'manufactureId',
            'options' => array(
                'label' => 'Manufacture:',
                'value_options' => $this->getManufactureOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'manufactureId'
            )
        ));
        
        // Model
        $this->add(array(
            'name' => 'modelId',
            'type' => 'Text',
            'options' => array(
                'label' => 'Model:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'modelId'
            )
        ));
        
        // username
        $this->add(array(
            'name' => 'username',
            'type' => 'Text',
            'options' => array(
                'label' => 'Management Username:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'username'
            )
        ));
        
        // password
        $this->add(array(
            'name' => 'password',
            'type' => 'Text',
            'options' => array(
                'label' => 'Management Password:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'password'
            )
        ));
        
        // ssid
        $this->add(array(
            'name' => 'ssid',
            'type' => 'Text',
            'options' => array(
                'label' => 'SSID:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'ssid'
            )
        ));
        
        // securityType
        $this->add(array(
            'type' => 'Select',
            'name' => 'securityType',
            'options' => array(
                'label' => 'Wireless Security:',
                'value_options' => $this->getSecurityTypeOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'securityType'
            )
        ));
        
        // securityPassword
        $this->add(array(
            'name' => 'securityPassword',
            'type' => 'Text',
            'options' => array(
                'label' => 'Wireless Security Password:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'securityPassword'
            )
        ));
        
        // Asset Tag
        $this->add(array(
            'name' => 'assetTagId',
            'type' => 'Text',
            'options' => array(
                'label' => 'Asset Tag:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'assetTagId'
            )
        ));
        
        // Serial Number
        $this->add(array(
            'name' => 'serialNumberId',
            'type' => 'Text',
            'options' => array(
                'label' => 'Serial Number:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'serialNumberId'
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
        return array();
    }

    private function getOperatingSystemOptions()
    {
        $options = array();
        
        $filter = array(
            'hostAttributeId' => 1,
            'pagination' => 'off'
        );
        
        $entitys = $this->valueService->getAll($filter);
        
        foreach ($entitys as $entity) {
            $options[$entity->getHostAttributeValueId()] = $entity->getHostAttributeValueName();
        }
        
        return $options;
    }

    private function getManufactureOptions()
    {
        $options = array();
        
        $filter = array(
            'hostAttributeId' => 2,
            'pagination' => 'off'
        );
        
        $entitys = $this->valueService->getAll($filter);
        
        foreach ($entitys as $entity) {
            $options[$entity->getHostAttributeValueId()] = $entity->getHostAttributeValueName();
        }
        
        return $options;
    }
    
    private function getSecurityTypeOptions()
    {
        $options = array();
        
        $filter = array(
            'hostAttributeId' => 4,
            'pagination' => 'off'
        );
        
        $entitys = $this->valueService->getAll($filter);
        
        foreach ($entitys as $entity) {
            $options[$entity->getHostAttributeValueId()] = $entity->getHostAttributeValueName();
        }
        
        return $options;
    }
}
