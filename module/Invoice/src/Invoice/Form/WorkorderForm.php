<?php
namespace Invoice\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Workorder\Service\WorkorderServiceInterface;

class WorkorderForm extends Form implements InputFilterProviderInterface
{
    /**
     * 
     * @var number
     */
    protected $clientId;
    
    /**
     * 
     * @var WorkorderServiceInterface
     */
    protected $workorderService;
    
    /**
     * 
     * @param WorkorderServiceInterface $workorderService
     * @param string $name
     * @param array $options
     */
    function __construct(WorkorderServiceInterface $workorderService, $name = 'invoice-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->workorderService = $workorderService;
        
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
    
    
    public function getWorkorderSelect()
    {
        // workorderId
        $this->add(array(
            'type' => 'Select',
            'name' => 'workorderId',
            'options' => array(
                'label' => 'Work Order:',
                'value_options' => $this->getWorkorderOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'workorderId'
            )
        ));
        
        
        return $this;
    }
    
    
    /**
     *
     * @param number $clientId
     * @return \Workorder\Form\WorkorderForm
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    
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
    
    private function getWorkorderOptions()
    {
        $entitys = $this->workorderService->getClientUnInvoiced($this->clientId);
        
               
        $options = array();
        
        foreach($entitys as $entity) {
            $options[$entity->getWorkorderId()] = 'Work Order #' . $entity->getWorkorderId();
        }
        
        return $options;
    }

}