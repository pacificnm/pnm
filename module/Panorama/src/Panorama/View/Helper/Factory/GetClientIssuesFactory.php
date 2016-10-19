<?php
namespace Panorama\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\View\Helper\GetClientIssues;

class GetClientIssuesFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Panorama\View\Helper\GetClientIssues
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $issueService = $realServiceLocator->get('Panorama\Service\IssueServiceInterface');
        
        return new GetClientIssues($issueService);
    }
}