<?php
namespace Application\Controller\Factory;

use Application\Controller\KeepAliveController;

class KeepAliveControllerFactory
{
    
    public function __invoke()
    {
        return new KeepAliveController();
    }
}

