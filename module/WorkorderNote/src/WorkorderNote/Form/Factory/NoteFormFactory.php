<?php
namespace WorkorderNote\Form\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WorkorderNote\Form\NoteForm;

class NoteFormFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $employeeService =$serviceLocator->get('Employee\Service\EmployeeServiceInterface');
        
        return new NoteForm($employeeService);
    }
}