<?php
namespace Host\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Host\Hydrator\HostHydrator;
use Host\Entity\HostEntity;
use HostType\Service\TypeServiceInterface;
use Location\Service\LocationServiceInterface;

class HostForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @var TypeServiceInterface
     */
    protected $typeService;
    
    /**
     * 
     * @var LocationServiceInterface
     */
    protected $locationService;
    
    /**
     * 
     * @var number
     */
    protected $clientId;
    
    /**
     * 
     * @param TypeServiceInterface $typeService
     * @param LocationServiceInterface $locationService
     * @param string $name
     * @param array $options
     * @return \Host\Form\HostForm
     */
    function __construct(TypeServiceInterface $typeService, LocationServiceInterface $locationService, $name = 'host-type-form', $options = array())
    {
       
    
        $this->typeService = $typeService;
        
        $this->locationService = $locationService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new HostHydrator(false));
    
        $this->setObject(new HostEntity());
    
        // hostTypeId
        $this->add(array(
            'name' => 'hostId',
            'type' => 'hidden'
        ));
        
        // clientId
        $this->add(array(
            'name' => 'clientId',
            'type' => 'hidden'
        ));
        
        
        
        // hostType
        $this->add(array(
            'type' => 'Select',
            'name' => 'hostType',
            'options' => array(
                'label' => 'Location:',
                'value_options' => $this->getHostOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'hostType'
            )
        ));
        
        // hostName
        $this->add(array(
            'name' => 'hostName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Host Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'hostName'
            )
        ));
        
        // hostIp
        $this->add(array(
            'name' => 'hostIp',
            'type' => 'Text',
            'options' => array(
                'label' => 'Host Ip:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'hostIp'
            )
        ));
        
        
        // hostStatus
        $this->add(array(
            'type' => 'Select',
            'name' => 'hostStatus',
            'options' => array(
                'label' => 'Status:',
                'value_options' => array(
                    'Active' => 'Active',
                    'Retired' => 'Retired'
                )
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'hostStatus'
            )
        ));
        
        // hostHealth
        $this->add(array(
            'name' => 'hostHealth',
            'type' => 'hidden'
        ));
        
        // hostCreated
        $this->add(array(
            'name' => 'hostCreated',
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

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        
        return $this;
    }
    
    public function getLocation()
    {
       
        // locationId
        $this->add(array(
            'type' => 'Select',
            'name' => 'locationId',
            'options' => array(
                'label' => 'Location:',
                'value_options' => $this->getLocationOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'locationId'
            )
        ));
    
        return $this;
    }
    
    private function getLocationOptions()
    {        
        $options = array();
    
        $entitys = $this->locationService->getAll(array(
            'clientId' => $this->clientId
        ));
    
        
        foreach ($entitys as $entity) {
            $options[$entity->getLocationId()] = $entity->getLocationStreet() . ' ' . $entity->getLocationCity();
        }
    
        return $options;
    }
    
    private function getHostOptions()
    {
        $options = array();
        
        $entitys = $this->typeService->getAll(array());
        
        foreach ($entitys as $entity) {
            $options[$entity->getHostTypeId()] = $entity->getHostTypeName();
        }
        
        return $options;
    }
    
}
