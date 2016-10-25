<?php
namespace PanoramaIssue\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use PanoramaIssue\Service\PanoramaIssueService;

class PanoramaIssueServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \PanoramaIssue\Service\PanoramaIssueService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('PanoramaIssue\Mapper\MysqlMapperInterface');
        
        return new PanoramaIssueService($mapper);
    }
}