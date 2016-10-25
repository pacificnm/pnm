<?php
namespace Panorama\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Panorama\Controller\IssueController;
class IssueControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Panorama\Controller\IssueController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $mspService = $realServiceLocator->get('Panorama\Service\MspServiceInterface');
        
        $issueService = $realServiceLocator->get('Panorama\Service\IssueServiceInterface');
        
        $panoramaClientEntity = $realServiceLocator->get('PanoramaClient\Service\PanoramaClientServiceInterface');
        
        return new IssueController($mspService, $issueService, $panoramaClientEntity);
    }
}