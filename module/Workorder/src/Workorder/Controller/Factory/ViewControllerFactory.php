<?php
namespace Workorder\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Workorder\Controller\ViewController;

class ViewControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $workorderService = $realServiceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        $workorderEmployeeService = $realServiceLocator->get('WorkorderEmployee\Service\WorkorderEmployeeServiceInterface');
        
        $noteService = $realServiceLocator->get('WorkorderNote\Service\NoteServiceInterface');
        
        $timeService = $realServiceLocator->get('WorkorderTime\Service\TimeServiceInterface');
        
        $partService = $realServiceLocator->get('WorkorderPart\Service\PartServiceInterface');
        
        $noteForm = $realServiceLocator->get('WorkorderNote\Form\NoteForm');
        
        $timeForm = $realServiceLocator->get('WorkorderTime\Form\TimeForm');
        
        return new ViewController($clientService, $workorderService, $workorderEmployeeService, $noteService, $timeService, $partService, $noteForm, $timeForm);
    }
}