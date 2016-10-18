<?php
namespace EmailTemplate\Controller\Factory;

use EmailTemplate\Controller\IndexController;
use Zend\ServiceManager\ServiceLocatorInterface;
class IndexControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \EmailTemplate\Controller\IndexController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        return new IndexController();
    }
}