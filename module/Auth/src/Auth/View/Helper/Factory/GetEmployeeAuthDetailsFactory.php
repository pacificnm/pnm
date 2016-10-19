<?php
namespace Auth\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\View\Helper\GetEmployeeAuthDetails;
class GetEmployeeAuthDetailsFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Auth\View\Helper\GetEmployeeAuthDetails
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $authService = $realServiceLocator->get('Auth\Service\AuthServiceInterface');
        
        return new GetEmployeeAuthDetails($authService);
    }
}