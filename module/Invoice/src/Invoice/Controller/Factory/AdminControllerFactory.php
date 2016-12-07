<?php
namespace Invoice\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Invoice\Controller\AdminController;

class AdminControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Invoice\Controller\AdminController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Invoice\Service\InvoiceServiceInterface');
        
        return new AdminController($service);
    }
}

