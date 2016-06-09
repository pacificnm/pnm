<?php
namespace InvoiceOption\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use InvoiceOption\Controller\UpdateController;
use InvoiceOption\Form\OptionForm;

class UpdateControllerFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $optionService = $realServiceLocator->get('InvoiceOption\Service\OptionServiceInterface');
        
        $optionForm = new OptionForm();
        
        return new UpdateController($optionService, $optionForm);
    }
}