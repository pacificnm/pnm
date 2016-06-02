<?php
namespace WorkorderEmployee\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Employee\Service\EmployeeServiceInterface;
use WorkorderEmployee\Hydrator\WorkorderEmployeeHydrator;
use WorkorderEmployee\Entity\WorkorderEmployeeEntity;

class WorkorderEmployeeForm extends Form implements InputFilterProviderInterface
{

    /**
     * 
     * @var EmployeeServiceInterface
     */
    protected $employeeService;

    /**
     * 
     * @param EmployeeServiceInterface $employeeService
     * @param string $name
     * @param array $options
     * @return \WorkorderEmployee\Form\WorkorderEmployeeForm
     */
    function __construct(EmployeeServiceInterface $employeeService, $name = 'workrder-form', $options = array())
    {
        $this->employeeService = $employeeService;
        
        parent::__construct($name, $options);
        
        $this->setHydrator(new WorkorderEmployeeHydrator(false));
        
        $this->setObject(new WorkorderEmployeeEntity());
        
        // workorderId
        $this->add(array(
            'name' => 'workorderEmployeeId',
            'type' => 'hidden'
        ));
        
        // workorderId
        $this->add(array(
            'name' => 'workorderId',
            'type' => 'hidden'
        ));
        
        // employeeId
        $this->add(array(
            'type' => 'Select',
            'name' => 'employeeId',
            'options' => array(
                'label' => 'Employee:',
                'value_options' => $this->getEmployeeOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'employeeId'
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

   

    /**
     * 
     */
    private function getEmployeeOptions()
    {
        $options = array();
        
        $entitys = $this->employeeService->getAll(array());
        
        foreach($entitys as $entity) {
            $options[$entity->getEmployeeId()] = $entity->getEmployeeName();
        }
        
        return $options;
    }
}