<?php
namespace Payroll\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Payroll\Hydrator\PayrollHydrator;
use Payroll\Entity\PayrollEntity;
use Employee\Service\EmployeeServiceInterface;


class PayrollForm extends Form implements InputFilterProviderInterface
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
     */
    public function __construct(EmployeeServiceInterface $employeeService, $name = 'payroll-form', $options = array())
    {
        parent::__construct($name, $options);
        
        $this->setHydrator(new PayrollHydrator(false));
        
        $this->setObject(new PayrollEntity());
        
        $this->employeeService = $employeeService;
        
        // payrollId
        $this->add(array(
            'name' => 'payrollId',
            'type' => 'hidden'
        ));
        
        
        // payrollCheck
        $this->add(array(
            'name' => 'payrollCheck',
            'type' => 'Text',
            'options' => array(
                'label' => 'Check Number:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollCheck'
            )
        ));
        
        // payrollDateCreate
        $this->add(array(
            'name' => 'payrollDateCreate',
            'type' => 'Text',
            'options' => array(
                'label' => 'Payroll Date:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollDateCreate'
            )
        ));
        
        
        // payrollRate
        $this->add(array(
            'name' => 'payrollRate',
            'type' => 'Text',
            'options' => array(
                'label' => 'Pay Rate:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollRate'
            )
        ));
        
        
        // payrollRateOt
        $this->add(array(
            'name' => 'payrollRateOt',
            'type' => 'Text',
            'options' => array(
                'label' => 'Over Time Pay Rate:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollRateOt'
            )
        ));
        
        // payrollWages
        $this->add(array(
            'name' => 'payrollWages',
            'type' => 'Text',
            'options' => array(
                'label' => 'Regular Pay:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollWages'
            )
        ));
        
        // payrollWagesOt
        $this->add(array(
            'name' => 'payrollWagesOt',
            'type' => 'Text',
            'options' => array(
                'label' => 'Over Time Wage:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollWagesOt'
            )
        ));
        
        // payrollWagesGross
        $this->add(array(
            'name' => 'payrollWagesGross',
            'type' => 'Text',
            'options' => array(
                'label' => 'Gross Pay:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollWagesGross'
            )
        ));
        
        // payrollWagesNet
        $this->add(array(
            'name' => 'payrollWagesNet',
            'type' => 'Text',
            'options' => array(
                'label' => 'Net Pay:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollWagesNet'
            )
        ));
        
        // payrollWagesVacation
        $this->add(array(
            'name' => 'payrollWagesVacation',
            'type' => 'Text',
            'options' => array(
                'label' => 'Vacation Pay:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollWagesVacation'
            )
        ));
        
        // payrollWagesSick
        $this->add(array(
            'name' => 'payrollWagesSick',
            'type' => 'Text',
            'options' => array(
                'label' => 'Sick Pay:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollWagesSick'
            )
        ));
        
        // payrollWagesState
        $this->add(array(
            'name' => 'payrollWagesState',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'payrollWagesState'
            )
        ));
        
        // payrollWagesSocialSecurity
        $this->add(array(
            'name' => 'payrollWagesSocialSecurity',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'payrollWagesSocialSecurity'
            )
        ));
        
        // payrollWagesMedicare
        $this->add(array(
            'name' => 'payrollWagesMedicare',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'payrollWagesMedicare'
            )
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
        
        // payrollDateStart
        $this->add(array(
            'name' => 'payrollDateStart',
            'type' => 'Text',
            'options' => array(
                'label' => 'Payroll Start:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollDateStart'
            )
        ));
        
        // payrollDateEnd
        $this->add(array(
            'name' => 'payrollDateEnd',
            'type' => 'Text',
            'options' => array(
                'label' => 'Payroll End:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollDateEnd'
            )
        ));
        
        // payrollHours
        $this->add(array(
            'name' => 'payrollHours',
            'type' => 'Text',
            'options' => array(
                'label' => 'Regular Hours:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollHours',
                'value' => 0
            )
        ));
        
        // payrollHoursOt
        $this->add(array(
            'name' => 'payrollHoursOt',
            'type' => 'Text',
            'options' => array(
                'label' => 'Overtime Hours:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollHoursOt',
                'value' => 0
            )
        ));
        
        // payrollHoursVacation
        $this->add(array(
            'name' => 'payrollHoursVacation',
            'type' => 'Text',
            'options' => array(
                'label' => 'Vacation Hours:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollHoursVacation',
                'value' => 0
            )
        ));
        
        // payrollHoursSick
        $this->add(array(
            'name' => 'payrollHoursSick',
            'type' => 'Text',
            'options' => array(
                'label' => 'Sick Hours:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollHoursSick',
                'value' => 0
            )
        ));
        
        // payrollTaxFederalIncome
        $this->add(array(
            'name' => 'payrollTaxFederalIncome',
            'type' => 'Text',
            'options' => array(
                'label' => 'Federal Income Tax:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollTaxFederalIncome'
            )
        ));
        
        // payrollTaxSocialSecurity
        $this->add(array(
            'name' => 'payrollTaxSocialSecurity',
            'type' => 'Text',
            'options' => array(
                'label' => 'Social Security Tax:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollTaxSocialSecurity'
            )
        ));
        
        // payrollTaxState
        $this->add(array(
            'name' => 'payrollTaxState',
            'type' => 'Text',
            'options' => array(
                'label' => 'State Tax:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollTaxState'
            )
        ));
        
        // payrollTaxMedicare
        $this->add(array(
            'name' => 'payrollTaxMedicare',
            'type' => 'Text',
            'options' => array(
                'label' => 'Medicare Tax:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'payrollTaxMedicare'
            )
        ));
        
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
                'class' => 'btn btn-primary btn-flat'
            )
        ));
    }
    
    /**
     * {@inheritDoc}
     * @see \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // payrollId
        );
        
    }
    
    /**
     * 
     * @return array
     */
    protected function getEmployeeOptions()
    {
        $options = array();
        
        $filter = array();
        
        $employeeEntitys = $this->employeeService->getAll($filter);
        
        $options[0] = 'Select One';
        
        
        foreach($employeeEntitys as $employeeEntity) {
            $options[$employeeEntity->getEmployeeId()] = $employeeEntity->getEmployeeName();
        }
        
        return $options;
    }

}
