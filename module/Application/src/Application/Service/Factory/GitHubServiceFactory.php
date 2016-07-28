<?php
namespace Application\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Service\GitHubService;

class GitHubServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Application\Service\GitHubService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {   
        $mapper = $serviceLocator->get('Application\Mapper\GitHubMapperInterface');
        
        
        return new GitHubService($mapper);
    }
}

