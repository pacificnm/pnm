<?php
namespace Cron\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Cron\Controller\CreateController;
use Cron\Form\CronForm;

class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Cron\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $cronService = $realServiceLocator->get('Cron\Service\CronServiceInterface');
        
        $form = new CronForm();
        
        return new CreateController($cronService, $form);
    }
}