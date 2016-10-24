<?php
namespace Cron\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Cron\Controller\UpdateController;
use Cron\Form\CronForm;

class UpdateControllerFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Cron\Controller\UpdateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $cronService = $realServiceLocator->get('Cron\Service\CronServiceInterface');
        
        $form = new CronForm();
        
        return new UpdateController($cronService, $form);
    }
}