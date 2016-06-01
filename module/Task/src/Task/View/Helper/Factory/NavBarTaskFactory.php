<?php
namespace Task\View\Helper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Task\View\Helper\NavBarTask;

class NavBarTaskFactory implements FactoryInterface
{

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $taskService = $realServiceLocator->get('Task\Service\TaskServiceInterface');
        
        return new NavBarTask($taskService);
    }
}