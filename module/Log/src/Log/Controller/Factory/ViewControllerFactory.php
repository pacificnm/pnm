<?php
namespace Log\Controller\Factory;

use Log\Controller\ViewController;
class ViewControllerFactory
{
    public function __invoke()
    {
        return new ViewController();
    }
}

?>