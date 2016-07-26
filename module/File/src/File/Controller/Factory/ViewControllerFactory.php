<?php
namespace File\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use File\Controller\ViewController;

class ViewControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \File\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $fileService = $realServiceLocator->get('File\Service\FileServiceInterface');
        
        return new ViewController($fileService);
    }
}

