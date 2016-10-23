<?php
namespace Panorama\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\View\Helper\GetDeviceIssues;

class GetDeviceIssuesFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Panorama\View\Helper\GetDeviceIssues
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $issueService = $realServiceLocator->get('Panorama\Service\IssueServiceInterface');
        
        return new GetDeviceIssues($issueService);
    }
}