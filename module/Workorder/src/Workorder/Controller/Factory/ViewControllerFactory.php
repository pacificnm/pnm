<?php
namespace Workorder\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Workorder\Controller\ViewController;
use WorkorderPart\Form\PartForm;
use Workorder\Form\CompleteForm;

class ViewControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Workorder\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $workorderEmployeeService = $realServiceLocator->get('WorkorderEmployee\Service\WorkorderEmployeeServiceInterface');
        
        $creditService = $realServiceLocator->get('WorkorderCredit\Service\CreditServiceInterface');
        
        $optionService = $realServiceLocator->get('WorkorderOption\Service\OptionServiceInterface');
        
        $noteForm = $realServiceLocator->get('WorkorderNote\Form\NoteForm');
        
        $timeForm = $realServiceLocator->get('WorkorderTime\Form\TimeForm');
        
        $partForm = new PartForm();
        
        $completeForm = new CompleteForm();
        
        $creditForm = $realServiceLocator->get('WorkorderCredit\Form\CreditForm');
        
        $employeeForm = $realServiceLocator->get('WorkorderEmployee\Form\WorkorderEmployeeForm');
        
        return new ViewController($clientService, $workorderService, $workorderEmployeeService, $creditService, $optionService, $noteForm, $timeForm, $partForm, $completeForm, $creditForm, $employeeForm);
    }
}