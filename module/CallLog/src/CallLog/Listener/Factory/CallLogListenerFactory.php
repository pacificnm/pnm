<?php
namespace CallLog\Listener\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use CallLog\Listener\CallLogListener;
class CallLogListenerFactory
{
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        return new CallLogListener();
    }
}