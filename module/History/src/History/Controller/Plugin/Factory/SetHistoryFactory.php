<?php
namespace History\Controller\Plugin\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use History\Controller\Plugin\SetHistory;

class SetHistoryFactory implements FactoryInterface
{

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $historyService = $realServiceLocator->get('History\Service\HistoryServiceInterface');
        
        return new SetHistory($historyService);
    }
}