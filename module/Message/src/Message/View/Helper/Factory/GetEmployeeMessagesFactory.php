<?php
namespace Message\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Message\View\Helper\GetEmployeeMessages;

class GetEmployeeMessagesFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Message\View\Helper\GetEmployeeMessages
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new GetEmployeeMessages();
    }
}