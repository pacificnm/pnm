<?php
namespace PanoramaIssue\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PanoramaIssue\Controller\ConsoleController;

class ConsoleControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PanoramaIssue\Controller\ConsoleController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $mspService = $realServiceLocator->get('Panorama\Service\MspServiceInterface');
        
        $issueService = $realServiceLocator->get('Panorama\Service\IssueServiceInterface');
        
        $panoramaIssueService = $realServiceLocator->get('PanoramaIssue\Service\PanoramaIssueServiceInterface');
        
        $panoramaClientService = $realServiceLocator->get('PanoramaClient\Service\PanoramaClientServiceInterface');
        
        return new ConsoleController($mspService, $issueService, $panoramaIssueService, $panoramaClientService);
    }
}