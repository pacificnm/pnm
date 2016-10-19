<?php
namespace Panorama\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\View\Helper\GetAllIssues;
class GetAllIssuesFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Panorama\View\Helper\GetAllIssues
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $issueService = $realServiceLocator->get('Panorama\Service\IssueServiceInterface');
        
        $mspService = $realServiceLocator->get('Panorama\Service\MspServiceInterface');
        
        
        return new GetAllIssues($issueService, $mspService);
    }
}
