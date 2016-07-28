<?php
namespace Application\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\IndexController;

class IndexControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Application\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
       
        
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $gitHubService = $realServiceLocator->get('Application\Service\GitHubServiceInterface');
        
        return new IndexController($gitHubService);
    }
}

