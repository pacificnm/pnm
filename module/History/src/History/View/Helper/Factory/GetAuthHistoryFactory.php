<?php
namespace History\View\Helper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use History\View\Helper\GetAuthHistory;

class GetAuthHistoryFactory implements FactoryInterface
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
        
        return new GetAuthHistory($historyService);
    }
}