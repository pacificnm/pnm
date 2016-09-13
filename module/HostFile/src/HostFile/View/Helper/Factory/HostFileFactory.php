<?php
namespace HostFile\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use HostFile\View\Helper\HostFile;

class HostFileFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \HostFile\View\Helper\HostFile
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $hostFileService = $realServiceLocator->get('HostFile\Service\HostFileServiceInterface');
        
        return new HostFile($hostFileService);
    }
}