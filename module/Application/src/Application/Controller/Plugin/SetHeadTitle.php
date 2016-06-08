<?php
namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\View\Renderer\PhpRenderer;

class SetHeadTitle extends AbstractPlugin
{
    
    /**
     *
     * @var Zend\View\Renderer\PhpRenderer
     */
    protected $phpRenderer;
    
    /**
     *
     * @param PhpRenderer $phpRenderer
     */
    public function __construct(PhpRenderer $phpRenderer)
    {
    
        $this->phpRenderer = $phpRenderer;
    }
    
    public function __invoke($title)
    {
        $this->phpRenderer->headTitle($title);
    }
}