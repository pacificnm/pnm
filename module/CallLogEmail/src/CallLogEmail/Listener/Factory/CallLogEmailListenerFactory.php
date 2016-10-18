<?php
namespace CallLogEmail\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use CallLogEmail\Listener\CallLogEmailListener;

class CallLogEmailListenerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \CallLogEmail\Listener\CallLogEmailListener
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $callLogEmailEntity = $serviceLocator->get('CallLogEmail\Service\CallLogEmailServiceInterface');
        
        return new CallLogEmailListener($callLogEmailEntity);
    }
}