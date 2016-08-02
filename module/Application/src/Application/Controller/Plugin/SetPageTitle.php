<?php
namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\View\Renderer\PhpRenderer;

class SetPageTitle extends AbstractPlugin
{

    /**
     *
     * @var array
     */
    protected $config;

    /**
     *
     * @var Zend\View\Renderer\PhpRenderer
     */
    protected $phpRenderer;

    /**
     *
     * @param array $config            
     * @param PhpRenderer $phpRenderer            
     */
    public function __construct(array $config, PhpRenderer $phpRenderer)
    {
        $this->config = $config;
        
        $this->phpRenderer = $phpRenderer;
    }

    public function __invoke($matchedRouteName)
    {
        if (array_key_exists('title', $this->config['router']['routes'][$matchedRouteName])) {
            $this->phpRenderer->headTitle($this->config['router']['routes'][$matchedRouteName]['title']);
        }
        
        return $this->config['router']['routes'][$matchedRouteName]['title'];
    }
    
    
}